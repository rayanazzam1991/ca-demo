<?php

namespace App\Core\CartItem\Infrastructure\Eloquent;

use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int   $qty
 * @property int   $created_at
 * @property int   $updated_at
 * @property float $price
 * @property float $total_price
 */
class CartItemModel extends Model
{
    use LogsActivity;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart_items';

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
        'cart_id',
        'item_id',
        'unit_item_id',
        'qty',
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
        'qty' => 'int',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;


    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Cart Item Model Log';
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
        $activity->subject_name_ar = trans('activity_log.cart_item_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.cart_item_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/

}
