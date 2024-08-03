<?php

namespace App\Core\Tenant\Infrastructure\Eloquent;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $created_at
 * @property int    $updated_at
 * @property string $database
 * @property string $domain
 * @property string $local_domain
 * @property string $name
 */
class TenantModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenants';

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
        'database', 'domain','local_domain', 'name', 'updated_at','created_at'
    ];

//    public static function boot() {
//        parent::boot();
//
//        //while creating/inserting item into db
//        static::creating(function (Tenant $tenant) {
//            echo "successfully fired";
//            domain1.shared-backend.pillstore.app
//            $domain = $tenant->domain;
//            $parts = explode($domain,'.');
//            if()
//            $tenant->local_domain = 'fooasdfasdfad'; //assigning value
//        });
//
//    }

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
        'created_at' => 'timestamp', 'database' => 'string', 'domain' => 'string', 'name' => 'string', 'updated_at' => 'timestamp'
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

}
