<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstAM extends Model
{
    use HasFactory;

    protected $table = 'mst_am';

    protected $guarded = [
        'id'
    ];
}
