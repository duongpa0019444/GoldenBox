<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'san_phams';

    protected $fillable = [
        'ten_san_pham_vi',
        'ten_san_pham_en',
        'mo_ta_ngan_vi',
        'mo_ta_ngan_en',
        'mo_ta',
        'mo_ta_en',
        'anh_chinh',
        'so_luong',
        'gia_goc_vi',
        'gia_goc_en',
        'danh_muc_id'
    ];
}