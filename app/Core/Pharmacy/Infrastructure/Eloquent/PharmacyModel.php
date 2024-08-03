<?php

namespace App\Core\Pharmacy\Infrastructure\Eloquent;

use App\Concerns\BaseModel;
use App\Concerns\Translate;
use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\Shared\Address\AddressModel;
use App\Core\Shift\Infrastructure\Eloquent\ShiftModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PharmacyModel extends Model
{
    use BaseModel,Translate,LogsActivity;
    protected array $translatable = ['name','description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pharmacies';

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
        'license_number',
        'phone_number',
        'status',
        'address_id',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
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
        'name_ar' => 'string',
        'name_en' => 'string',
        'phone_number' => 'string',
        'license_number' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at' => 'timestamp',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function address():BelongsTo
    {
        return $this->belongsTo(AddressModel::class);
    }

    public function shifts():HasMany
    {
        return $this->hasMany(ShiftModel::class,'pharmacy_id');
    }

    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Pharmacy Model Log';
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
        $activity->subject_name_ar = trans('activity_log.pharmacy_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.pharmacy_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
