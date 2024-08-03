<?php
namespace App\Core\ActivityLog\Infrastructure\Eloquent;

use App\Core\Shared\User\UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    protected $table = 'activity_log';
    protected static function boot()
    {
        parent::boot();
    }

    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'causer_id','id');
    }
}
