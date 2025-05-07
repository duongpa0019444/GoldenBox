<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    //
    protected $appends = ['tong_tien_formatted'];
    protected $table = 'don_hangs';
    public function chiTietDonHangs()
    {
        return $this->hasMany(ordersDetail::class, 'id_don_hang'); // hoặc 'order_id' tùy tên cột
    }

    public function getTongTienFormattedAttribute()
    {
        return number_format($this->tong_tien, 0, ',', '.') . ' ₫';
    }

}
