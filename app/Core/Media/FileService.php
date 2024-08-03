<?php

namespace App\Core\Media;

use App\Enums\PathEnum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class FileService
{
    public static function store(UploadedFile $file, string $path, string $name = null): bool|array|null
    {
        if(!$path)$path = PathEnum::other->value;
        if(!$name)$name = now()->format('YmdHisu');
        if(!File::exists(public_path('storage/'.$path)))File::makeDirectory(public_path('storage/'.$path));
        $data = ['file_name'=>$name.'_.webp','size'=>$file->getSize(),'disk'=>'storage','mime_type'=>$file->getExtension()];
        $stored = Image::make($file)->encode('webp')->save(public_path('storage/'.$path.$name.'_.webp'));
        return $stored ? $data : false;
    }

    public static function delete(string $path):void
    {
        $path = 'public/' . $path;
        if (file_exists(Storage::path($path)))
            Storage::delete($path);
    }
}
