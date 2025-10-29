<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstCbgPH extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_cbg_ph';

    protected $guarded = [
        'id'
    ];
}
