<?php

namespace App\Core\Distributor\Application\UseCases\CreateDistributor;

use App\Concerns\BaseFilter;
use App\Concerns\BaseFilterMapper;
use App\Core\DeliveryGroup\Application\Filter\DeliveryGroupFilter;
use App\Core\DeliveryGroup\Application\Mappers\DeliveryGroupMapper;
use App\Core\DeliveryGroup\Application\Repositories\DeliveryGroupRepositoryInterface;
use App\Core\DeliveryMan\Application\Filter\DeliveryManFilter;
use App\Core\DeliveryMan\Application\Mappers\DeliveryManMapper;
use App\Core\DeliveryMan\Application\Repositories\DeliveryManRepositoryInterface;
use App\Core\Distributor\Application\DTO\DistributorDTO;
use App\Core\Distributor\Application\Mappers\DistributorMapper;
use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Application\Repositories\SharedSystemRepositoryInterface;
use App\Core\Distributor\Application\Repositories\UpdateDistributorGateWayRepositoryInterface;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\DistributorSubscription\Application\Mappers\DistributorSubscriptionMapper;
use App\Core\DistributorSubscription\Application\Repositories\StoreSubscriptionGateWayRepositoryInterface;
use App\Core\DistributorSubscription\Domain\Enums\SubscriptionEnum;
use App\Core\DistributorSubscription\Infrastructure\Eloquent\DistributorSubscriptionRepository;
use App\Core\Manufacturer\Application\Filter\ManufacturerFilter;
use App\Core\Manufacturer\Application\Repositories\ManufacturerRepositoryInterface;
use App\Core\Media\MediaService;
use App\Core\PaymentType\Application\Repositories\PaymentMethodRepositoryInterface;
use App\Core\Shared\Address\AddressRepositoryInterface;
use App\Core\Shared\City\CityFilter;
use App\Core\Shared\City\CityRepositoryInterface;
use App\Core\Shared\Region\RegionFilter;
use App\Core\Shared\Region\RegionRepositoryInterface;
use App\Core\Shared\Region\RegionUseCaseInterface;
use App\Core\Tenant\Infrastructure\Eloquent\TenantRepository;
use App\Events\SyncDeliveryImageEvent;
use App\Jobs\SyncDeliveryManImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateDistributorUseCaseInteractor implements CreateDistributorUseCaseInterface
{
    public function __construct(
        private readonly DistributorRepositoryInterface    $distributorRepository,
        private readonly DistributorSubscriptionRepository $distributorSubscriptionRepository,
        private readonly AddressRepositoryInterface        $addressRepository,
        private readonly TenantRepository                  $tenantRepository,
        private readonly SharedSystemRepositoryInterface   $sharedSystemRepository,
        private readonly MediaService                      $mediaService,
        private readonly PaymentMethodRepositoryInterface  $paymentMethodRepository,
        private readonly DeliveryManRepositoryInterface  $deliveryManRepository,
        private readonly DeliveryGroupRepositoryInterface  $deliveryGroupRepository,
        private readonly CityRepositoryInterface  $cityRepository,
        private readonly RegionRepositoryInterface  $regionRepository,
        private readonly ManufacturerRepositoryInterface $manufacturerRepository,
        private readonly StoreSubscriptionGateWayRepositoryInterface $storeSubscriptionGateWayRepository,
        private readonly UpdateDistributorGateWayRepositoryInterface $updateDistributor,
    ) {
    }

    public function store(DistributorEntity $distributorEntity, string $username)
    {
        try {
            DB::beginTransaction();
            $tenant = $this->tenantRepository->store($distributorEntity->tenant);
            $address = $this->addressRepository->store($distributorEntity->address);
            $distributor = $this->distributorRepository->store($distributorEntity, $address->id, $tenant->id);
            !isset($distributorEntity->image) ?: $this->mediaService->store($distributor->id, 'distributor', $distributorEntity->image);
            $this->distributorSubscriptionRepository->store(DistributorSubscriptionMapper::fromRequest(['distributor_id' => $distributor->id, 'type' => SubscriptionEnum::ThreeMonth->value]));
            $password = $this->generateRandomPassword();
            $alameenKey = Str::random(32);
            DB::commit();
            $this->sharedSystemRepository->createDB(
                DistributorDTO::fromEloquentToSharedSystem($distributor, $tenant->database, $tenant->local_domain),
                $this->paymentMethodRepository->index(BaseFilterMapper::fromRequest([])),
                $this->deliveryGroupRepository->index(DeliveryGroupFilter::fromRequest([])),
                $this->deliveryManRepository->index(DeliveryManFilter::fromRequest(["status" => 1])),
                $this->cityRepository->index(CityFilter::fromRequest([])),
                $this->regionRepository->index(RegionFilter::fromRequest(['is_parent' => true])),
                $this->regionRepository->index(RegionFilter::fromRequest(['is_not_parent' => true])),
                $this->manufacturerRepository->index(ManufacturerFilter::fromRequest(["status" => 1])),
                $username,
                $password,
                $alameenKey
            );
            $this->storeSubscriptionGateWayRepository->store(DistributorSubscriptionMapper::fromRequest([
                'distributor_id' => $distributor->id, 'type' => SubscriptionEnum::ThreeMonth->value, 'paid_amount' => 0
            ]), $tenant->local_domain);
            $this->updateDistributor->update(DistributorMapper::fromRequest($this->distributorRepository->show($distributor->id)->toArray(), $distributorEntity->image), $tenant->local_domain);
            return $this->prepareResponse($username, $password, $tenant->domain, $distributor->phone_number , $alameenKey);
            SyncDeliveryImageEvent::dispatch();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
    private function generateRandomPassword(): string
    {
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?.&#])[A-Za-z\d@$!%*?.&#]{8,}$/';
        $requiredChars = ['abcdefghijklmnopqrstuvwxyz', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', '0123456789', '@$!%*?.&#'];
        $password = '';
        $attemptLimit = 10; 
        $attemptCount = 0;
    
        do {
            $password = '';
            foreach ($requiredChars as $charGroup) {
                $randomChar = $charGroup[random_int(0, strlen($charGroup) - 1)];
                $password .= $randomChar;
                $randomChar = $charGroup[random_int(0, strlen($charGroup) - 1)];
                $password .= $randomChar;
            }
            $matchesPattern = preg_match($pattern, $password);
            $attemptCount++;
        } while (!$matchesPattern && $attemptCount < $attemptLimit);
        if (!$matchesPattern) {
            $password = 'Password@Pill.Store2023';
        }
        return $password;
    }
    private function prepareResponse(string $username, string $password, string $domain, string $mobileNumber, string $alameenKey): array
    {
        $domainParts = explode(".", $domain);
        $domain = $domainParts[0];
        return [
            'username' => $username,
            'password' => $password,
            'domain' => (env('APP_ENV')  === 'local' ? 'http://' : 'https://') . $domain . '.' . env('DISTRIBUTOR_DASHBOARD_BASE', ''),
            'mobile_number' => $mobileNumber,
            'alameen_key' => $alameenKey

        ];
    }
}
