<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class san_phams extends Model
{
    protected $table = 'san_phams';
    protected $fillable = [
        'ten_san_pham_vi',
        'id_danh_muc',
        'mo_ta_vi',
        'gia_goc_vi',
        'so_luong',
        'so_luot_mua',
        'anh_chinh',
    ];

    public function danhMuc()
    {
        return $this->belongsTo('App\Models\danh_mucs', 'id_danh_muc');
    }
}
