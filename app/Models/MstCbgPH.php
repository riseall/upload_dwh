<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstCbgPH extends Model
{
    use HasFactory;

    protected $table = 'mst_cbg_ph';

    protected $guarded = [
        'id'
    ];
}
