<?php

namespace App\Core\Auth;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @property string $code
 * @property string $phone_number
 * @property int    $created_at
 * @property int    $deleted_at
 * @property int    $updated_at
 */
class UserCodeModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_codes';

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
        'phone_number',
        'code',
        'is_expire',
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
        'code' => 'string',
        'phone_number' => 'string',
        'is_expire' => 'bool',
        'created_at' => 'timestamp',
        'deleted_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // public function code(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn($value) => $this->attributes['code'] = Hash::make($value),
    //     );
    // }

}
