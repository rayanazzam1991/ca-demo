<?php

namespace App\Core\Shared\Region;

use App\Concerns\BaseModel;
use App\Concerns\HasTranslatedName;
use App\Core\Shared\City\CityModel;
use App\Core\Shared\User\UserModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionModel extends Model
{
    use BaseModel,HasTranslatedName;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            isset($model->code)?:$model->code= uuid_create();
        });
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'regions';

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
        'status',
        'code',
        'parent_region_id',
        'city_id',
        'created_by',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
        'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function city():BelongsTo
    {
        return $this->belongsTo(CityModel::class);
    }

    public function parentRegion():BelongsTo
    {
        return $this->belongsTo(RegionModel::class,'parent_region_id');
    }

    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'created_by');
    }

}
