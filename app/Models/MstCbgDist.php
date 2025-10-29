<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstCbgDist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mst_cbg_dist';

    protected $primaryKey = 'id_cbg_dist';

    public $incrementing = true;

    protected $guarded = [
        'id'
    ];
}
