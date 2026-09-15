<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
//     protected $fillable = [
//     'nama_pegawai',
//     'email',
//     'nik',
//     'alamat',
//     'umur',
//     'tanggal_lahir',
//     'tempat_lahir' ,
//     'jenis_kelamin',
//     'foto',
// ];

public function user()
{
    return $this->hasOne(User::class);
}

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
