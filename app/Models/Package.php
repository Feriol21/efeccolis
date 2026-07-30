<?php

namespace App\Models;

use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'tracking_number',
        'first_name',
        'last_name',
        'address',
        'status',
        'message',
    ];

    protected $casts = [
        'status' => PackageStatus::class,
    ];
}
