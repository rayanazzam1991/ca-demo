<?php
namespace App\Core\PaymentType\Infrastructure\Eloquent;

use App\Concerns\HasTranslatedName;
use App\Concerns\Translate;
use App\Core\Shared\User\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

class PaymentTypeModel extends Model
{
    use HasFactory,Translate;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            isset($model->code)?:$model->code= uuid_create();
        });
    }

    protected $table='payment_types';

    protected $fillable = [
        'name_en',
        'name_ar',
        'code',
        'status',
        'created_by',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
    ];

    protected array $translatable = ['name'];

    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'created_by','id');
    }
}
