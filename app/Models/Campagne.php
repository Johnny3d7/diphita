<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($item) {
            $prefix = 'CAMP';
            $res = ($item->id < 10) ? '000' : (($item->id < 100) ? '00' : (($item->id < 1000) ? '0' : '')) . $item->id;
            $item->reference = $prefix.$res;
        });
    }
}
