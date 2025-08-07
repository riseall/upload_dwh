<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstCustDist extends Model
{
    use HasFactory;

    protected $table = 'mst_cust_dist';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'pasar' => 'array'
    ];
}
