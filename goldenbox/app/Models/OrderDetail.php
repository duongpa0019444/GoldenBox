<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    
    protected $table = 'chi_tiet_don_hangs'; // Đảm bảo tên bảng khớp với cơ sở dữ liệu
    protected $fillable = [
        'id_don_hang',
        'id_san_pham',
        'so_luong',
        'don_gia',
        // Các trường khác trong bảng chi_tiet_don_hangs
    ];
    public function donHang(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_don_hang');
    }

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_san_pham');
    }
}
