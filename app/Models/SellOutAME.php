<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOutAME extends Model
{
    use HasFactory;

    protected $table = 'selling_out_ame';

    protected $guarded = [
        'id'
    ];
}
