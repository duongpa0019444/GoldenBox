<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;


    protected $table = 'don_hangs'; // Đảm bảo tên bảng khớp với cơ sở dữ liệu
    protected $fillable = [
        'id_user',
        'trang_thai_giao_hang',
        'trang_thai_thanh_toan',
        'tong_tien',
        'ghi_chu',
        'phuong_thuc_thanh_toan',
        'id_ma_khuyen_mai',
        'ho_ten',
        'email',
        'so_dien_thoai',
        'dia_chi',
        'created_at',
        'updated_at',
    ];

    public function chiTietDonHangs(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'id_don_hang', 'id');
    }
}
