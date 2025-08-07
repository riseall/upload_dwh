<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOutKME extends Model
{
    use HasFactory;

    protected $table = 'selling_out_kme';

    protected $guarded = [
        'id'
    ];
}
