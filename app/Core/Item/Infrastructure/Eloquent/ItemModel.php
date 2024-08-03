<?php

namespace App\Core\Item\Infrastructure\Eloquent;

use App\Concerns\BaseModel;
use App\Concerns\Translate;
use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Type\TypeModel;
use App\Enums\PathEnum;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ItemModel extends Model
{
    use BaseModel,Translate,LogsActivity;
    protected array $translatable = ['name','description'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

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
        'description_ar',
        'description_en',
        'price',
        'new_price',
        'file_name',
        'distributor_id',
        'deleted_at',
        'updated_at',
        'created_at',
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
        'name_ar' => "string",
        'name_en'=> "string",
        'description_ar'=> "string",
        'description_en'=> "string",
        'price' => 'float',
        'new_price' => 'float',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    protected $appends = ['img'];

    public function img():Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if(!$value) return null;
                asset('storage/'.PathEnum::item->value.$value);
            }
        );
    }

    public function types():BelongsToMany
    {
        return $this->belongsToMany(TypeModel::class,'item_types','item_id','type_id');
    }

    public function distributor():BelongsTo
    {
        return $this->BelongsTo(DistributorModel::class);
    }

    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'Item Model Log';
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
        $activity->subject_name_ar = trans('activity_log.items_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.items_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
