<?php

namespace App\Core\Favourite\Infrastructure\Eloquent;

use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class FavouriteModel extends Model
{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'favourites';

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
        'user_id',
        'distributor_id',
        'item_id',
        'status',
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
          'status' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;
    public function distributor():BelongsTo
    {
        return $this->belongsTo(DistributorModel::class,'distributor_id');
    }


    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Cart Model Log';
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
        $activity->subject_name_ar = trans('activity_log.cart_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.cart_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
