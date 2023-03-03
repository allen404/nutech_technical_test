<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $fillable = ['nama_barang','harga_beli','harga_jual','stok','foto_barang'];

    protected $table = 'barang';
    protected $primaryKey = 'id';

    public $timestamps = false;
}
