<?php

namespace App\Core\Shift\Infrastructure\Eloquent;

use App\Core\Pharmacy\Infrastructure\Eloquent\PharmacyModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShiftModel extends Model
{
    use HasFactory;

    protected $table = 'shifts';

    protected $fillable = [
        'pharmacy_id',
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function pharmacy():BelongsTo
    {
        return $this->belongsTo(PharmacyModel::class);
    }
}
