<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use HasFactory,SoftDeletes;

    public function scopeGetData($query)
    {
        if (isset(request()->number) && request()->number != -1)
            $records = $query->paginate(request()->number);
        else $records = $query->get();
        return $records;
    }


}
