<?php

namespace App\Core\Feed\Infrastructure\Eloquent;

use App\Concerns\BaseModel;
use App\Concerns\Translate;
use App\Core\ActivityLog\Infrastructure\Eloquent\ActivityLog;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Shared\User\UserModel;
use App\Enums\PathEnum;
use App\Models\Media;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property string $name_ar
 * @property string $name_en
 * @property string $description_ar
 * @property string $description_en
 * @property string $file_name
 * @property int    $deleted_at
 * @property int    $created_at
 * @property int    $updated_at
 */
class FeedModel extends Model
{
    use BaseModel,Translate,LogsActivity;
    protected array $translatable = ['name'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feeds';

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
        'title_ar',
        'title_en',
        'description',
        'status',
        'created_by',
        'deleted_at',
        'created_at',
        'updated_at'
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
        // 'deleted_at' => 'timestamp',
        // 'created_at' => 'timestamp',
        // 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        // 'deleted_at',
        // 'created_at',
        // 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */

    public function medias():MorphOne
    {
        return $this->morphOne(Media::class,'image');
    }

    public function createdUser():BelongsTo
    {
        return $this->belongsTo(UserModel::class,'created_by');
    }

    /*Activity Log*/
    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }
    public function getLogNameToUse(string $eventName = ''): string
    {
        return 'News Model Log';
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
        $activity->subject_name_ar = trans('activity_log.news_model', [], 'ar');
        $activity->subject_name_en = trans('activity_log.news_model', [], 'en');
        $activity->event_ar = trans('activity_log.' . $eventName , [], 'ar');
    }
    /*End Activity Log*/
}
