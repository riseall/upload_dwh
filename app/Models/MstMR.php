<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstMR extends Model
{
    use HasFactory;

    protected $table = 'mst_mr';

    protected $guarded = [
        'id'
    ];
}
