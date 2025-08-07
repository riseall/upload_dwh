<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstSAM extends Model
{
    use HasFactory;

    protected $table = 'mst_sam';

    protected $guarded = [
        'id'
    ];
}
