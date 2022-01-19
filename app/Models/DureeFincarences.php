<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DureeFincarences extends Model
{
    use HasFactory;

    protected $table = 'duree_fincarences';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'duree',
        'status',
    ];
}
