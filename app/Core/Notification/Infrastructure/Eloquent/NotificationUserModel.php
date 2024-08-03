<?php

namespace App\Core\Notification\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class NotificationUserModel extends Model
{
    use HasFactory;

    protected $table = 'notification_users';

    protected $fillable = [
        'user_id',
        'user_type',
        'notification_id'
    ];

    protected $casts = [
        'deleted_at' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    public function notification():BelongsTo
    {
        return $this->belongsTo(NotificationModel::class);
    }
    public function user():MorphTo
    {
        return $this->morphTo();
    }
}
