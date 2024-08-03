<?php

namespace App\Core\ItemType;

use App\Concerns\BaseModel;
use App\Concerns\HasTranslatedName;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $updated_at
 * @property int $created_at
 * @property int $deleted_at
 * @property int $status
 */
class ItemTypeModel extends Model
{
    use BaseModel,HasTranslatedName;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_types';

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
        'item_id',
        'type_id',
        'status',
        'updated_at',
        'created_at',
        'deleted_at',
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
        'updated_at' => 'timestamp',
        'created_at' => 'timestamp',
        'deleted_at' => 'timestamp',
        'status' => 'bool'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at', 'created_at', 'deleted_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
