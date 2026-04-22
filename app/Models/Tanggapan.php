<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;
    protected $table = 'tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'tgl_tanggapan',
        'tanggapan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}