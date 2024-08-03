<?php

namespace App\Core\Shared\User;

use App\Concerns\BaseModel;
use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class UserModel extends Authenticatable
{
    use BaseModel,HasApiTokens,HasRoles;


    protected $table = 'users';
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
        'full_name_ar',
        'username',
        'phone_number',
        'password',
        'status',
        'fcm_token',
        'lang',
        'date_of_birth',
        'gender',
        'default_role_id',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_update'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
      'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'full_name_ar' => 'string',
        'username' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'last_update' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_update'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    public function pharmacy():HasOne
    {
        return $this->hasOne(PharmacyModel::class,'created_by');
    }

    public function medias():MorphMany
    {
        return $this->morphMany(Media::class,'image');
    }
}
