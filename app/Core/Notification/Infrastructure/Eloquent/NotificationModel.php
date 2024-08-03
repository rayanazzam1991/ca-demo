<?php

namespace App\Core\Notification\Infrastructure\Eloquent;

use App\Concerns\Translate;
use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Core\Shared\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notification;

class NotificationModel extends Model
{
    use HasFactory,Translate;

    protected $table = 'notifications';

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'schedule_time',
        'type',
        'status',
        'created_by'
    ];
    protected array $translatable = ['title','description'];

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'schedule_time' => 'datetime'
    ];

    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'created_by');
    }
    public function users():MorphMany
    {
        return $this->morphMany(NotificationUserModel::class,'user');
    }

    public function user_ids():array
    {
        return NotificationUserModel::where('notification_id',$this->id)->where('user_type',UserModel::class)->get()->pluck('user_id')->toArray();
    }

    public function delivery_man_ids():array
    {
        return NotificationUserModel::where('notification_id',$this->id)->where('user_type',DeliveryManModel::class)->get()->pluck('user_id')->toArray();
    }
}
