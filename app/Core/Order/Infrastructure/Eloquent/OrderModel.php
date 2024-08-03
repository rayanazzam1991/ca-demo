<?php

namespace App\Core\Order\Infrastructure\Eloquent;

use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderModel extends Model
{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
         'user_id','distributor_id', 'order_id', 'created_at', 'updated_at'
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
        'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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
        return 'Order Model Log';
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
        $activity->subject_name_ar = trans('activity_log.order_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.order_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
