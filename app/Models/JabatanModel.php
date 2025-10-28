<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;

    protected $table = 'mst_jabatan';

    public function users()
    {
        return $this->hasMany(User::class, 'id_jabatan', 'id_jabatan');
    }
}
