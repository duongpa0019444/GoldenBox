<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'ma_khuyen_mais';
    protected $fillable = ['ma_code', 'loai', 'gia_tri', 'trang_thai', 'ngay_bat_dau', 'ngay_ket_thuc'];
    protected $dates = ['ngay_bat_dau', 'ngay_ket_thuc', 'created_at', 'updated_at'];

    public function scopeActive($query)
    {
        return $query->where('trang_thai', 'con_hieu_luc')
            ->where('ngay_bat_dau', '<=', now())
            ->where('ngay_ket_thuc', '>=', now());
    }
}