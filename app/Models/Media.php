<?php

namespace App\Models;

use App\Enums\PathEnum;
use App\Core\Media\FileService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'medias';

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
        'image_type',
        'image_id',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'is_featured',
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
        'image_type' => 'string',
        'file_name' => 'string',
        'mime_type' => 'string',
        'disk' => 'string',
        'size' => 'string',
        'is_featured' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */

    protected $appends = ['url'];
    public $timestamps = true;

    public function url():Attribute
    {
        $model_class =app($this->image_type);
        return Attribute::make(
            get: fn() => asset('storage/'. PathEnum::getPath($model_class::class).$this->file_name),
        );
    }
    public function medias():MorphTo
    {
        return $this->morphTo('image');
    }

    public function deletewithImage():void
    {
        $model_class =app($this->image_type);
        FileService::delete(PathEnum::getPath($model_class::class).$this->file_name);
        $this->delete();
    }

}
