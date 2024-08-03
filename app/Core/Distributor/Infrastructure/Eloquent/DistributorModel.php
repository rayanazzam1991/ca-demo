<?php

namespace App\Core\Distributor\Infrastructure\Eloquent;

use App\Concerns\BaseModel;
use App\Concerns\Translate;
use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\DistributorSubscription\Infrastructure\Eloquent\DistributorSubscriptionModel;
use App\Core\Shared\Address\AddressModel;
use App\Core\Shared\User\UserModel;
use App\Core\Tenant\Infrastructure\Eloquent\TenantModel;
use App\Enums\PathEnum;
use App\Models\Media;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property string $phone_number
 * @property int    $deleted_at
 * @property int    $created_at
 * @property int    $updated_at
 */
class DistributorModel extends Model
{
    use BaseModel,Translate, LogsActivity;

    protected array $translatable = ['name'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'distributors';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar',
        'name_en',
        'phone_number',
        'email',
        'status',
        'address_id',
        'tenant_id',
        'created_by',
        'status',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_number' => 'string',
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function medias():MorphOne
    {
        return $this->morphOne(Media::class,'image');
    }

    public function address():BelongsTo
    {
        return $this->belongsTo(AddressModel::class);
    }
    public function tenant():BelongsTo
    {
        return $this->belongsTo(TenantModel::class,'tenant_id');
    }
    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'created_by');
    }

    public function subscriptions():HasMany
    {
        return $this->hasMany(DistributorSubscriptionModel::class,'distributor_id');
    }

    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Distributor Model Log';
    }
    public function getCauser(): ?Authenticatable
    {
        return auth()->user();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    public function tapActivity(ActivityLog $activity, string $eventName)
    {
        $activity->subject_name_ar = trans('activity_log.distributor_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.distributor_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
