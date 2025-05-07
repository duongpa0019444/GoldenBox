<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // session()->flush();

        // return redirect()->back()->with('success', 'Giỏ hàng đã được xóa sạch!');
        // exit()

        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        // Kiểm tra tồn kho
        if ($product->so_luong <= 0) {
            return redirect()->route('home')->with('error', 'Sản phẩm đã hết hàng!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Kiểm tra nếu tăng số lượng vượt quá tồn kho
            if ($cart[$productId]['quantity'] >= $product->so_luong) {
                return redirect()->route('home')->with('error', 'Số lượng vượt quá tồn kho!');
            }
            $cart[$productId]['quantity']++;
            // dd($cart);
        } else {
            $cart[$productId] = [
                // 'id' => $product->id,
                'name_vi' => $product->ten_san_pham_vi,
                'name_en' => $product->ten_san_pham_en,
                'price_vi' => $product->gia_goc_vi,
                'price_en' => $product->gia_goc_en,
                'description_vi' => $product->mo_ta_vi,
                'description_en' => $product->mo_ta_en,
                'image' => $product->anh_chinh,
                // 'weight' => '400 g', // Điều chỉnh dựa trên dữ liệu thực tế
                'quantity' => 1,
                'stock' => $product->so_luong
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('home')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function clearCart()
    {
        // Xóa sạch tất cả session hiện tại của người dùng
        session()->flush();

        return redirect()->route('home')->with('success', 'Giỏ hàng đã được xóa sạch!');
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart');

        if (isset($cart[$productId]) && $quantity >= 1 && $quantity <= $cart[$productId]['stock']) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
        // Tinh gia tien san pham
        $subtotal = $cart[$productId]['price_vi'] * $quantity;

        //Tinh tong tien gio hang
        $total = array_sum(array_map(function ($item) {
            return $item['price_vi'] * $item['quantity'];
        }, $cart));

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật giỏ hàng thành công!',
            'subtotal' => $subtotal,
            'total' => $total

        ]);
        // return redirect()->back()->with('success', 'Số lượng đã được cập nhật!');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        //Tinh tong tien gio hang
        $total = array_sum(array_map(function ($item) {
            return $item['price_vi'] * $item['quantity'];
        }, $cart));

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật giỏ hàng thành côn   g!',
            'total' => $total
            // (Tùy chọn) Trả về thêm dữ liệu như tổng tiền
            // 'total' => calculateTotal($cart)
        ]);
    }

    // Hiển thị trang thanh toán
    public function checkout(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $validator = Validator::make($request->all(), [
                // 'id_user' => 'required|exists:users,id',
                'phuong_thuc_thanh_toan' => 'required|string|max:255',
                // 'id_ma_khuyen_mai' => 'nullable|exists:ma_khuyen_mais,id',
                'ho_ten_' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'so_dien_thoai' => 'required|string|max:20',
                'dia_chi' => 'required|string|max:255',
                'ghi_chu' => 'nullable|string',
            ]);

            DB::beginTransaction(); // Bắt đầu một giao dịch: gom nhiều thao tác DB lại, nếu có lỗi sẽ rollback
            $sessionCoupon = Session::get('coupon');
            $donHang = Order::create([
                'id_user' => null,
                'phuong_thuc_thanh_toan' => $request->input('phuong_thuc_thanh_toan'),
                'created_at' => now(),
                'id_ma_khuyen_mai' =>  $sessionCoupon['id'] ?? null,
                'tong_tien' => 0,
                'ho_ten'=> $request->input('ho_ten'),
                'email' => $request->input('email'),
                'so_dien_thoai' => $request->input('so_dien_thoai'),
                'dia_chi' => $request->input('dia_chi'),
                'ghi_chu' => $request->input('ghi_chu'),
                // 'trang_thai_giao_hang' => 'chua_giao_hang', // Giá trị mặc định khi tạo đơn hàng
                // 'trang_thai_thanh_toan' => 'chua_thanh_toan', // Giá trị mặc định khi tạo đơn hàng
            ]);
            $tongTienDonHang = 0;
            $chiTietDonHangs = [];
            $gioHang = Session::get('cart');
            foreach ($gioHang as $itemId => $item) {
                // Giả định $itemId là id_san_pham và $item['quantity'] là so_luong
                $sanPham = Product::findOrFail($itemId);
                $donGia = $sanPham->gia_goc_vi ?? 0;

                $chiTietDonHang = new OrderDetail([
                    'id_don_hang' => $donHang->id,  
                    'id_san_pham' => $itemId,
                    'so_luong' => $item['quantity'],
                    'don_gia' => $item['price_vi'] * $item['quantity'],
                ]);
                $chiTietDonHangs[] = $chiTietDonHang;
                $tongTienDonHang += $donGia * $item['quantity'];
            
            }
            // dd($tongTienDonHang);
            $donHang->chiTietDonHangs()->saveMany($chiTietDonHangs);

            if(isset($sessionCoupon['id'])){
                $tongTienDonHang = $sessionCoupon['total'];
            }
            $donHang->update(['tong_tien' => $tongTienDonHang]);

            DB::commit(); // Ghi vĩnh viễn các thay đổi vào DB nếu mọi thứ OK
            DB::rollBack(); //Có lỗi → huỷ bỏ tất cả thay đổi
            return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
        } else {

            $cart = session()->get('cart', []);
            $total = 0;

            // Tính tổng tiền giỏ hàng
            foreach ($cart as $item) {
                $subtotal = $item['price_vi'] * $item['quantity'];
                $total += $subtotal;
            }

            // $vat = $total * 0.1; //tính thuế
            // $totalWithVat = $total + $vat; //tổng tiền sau khi trừ thuế

            return view('client.checkout', compact('cart', 'total'));
        }
    }
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng của bạn đang trống!',
                'total' => 0
            ], 200);
        }

        $total = array_sum(array_map(fn($item) => $item['price_vi'] * $item['quantity'], $cart));

        $coupon = Coupon::where('ma_code', $couponCode)
            ->where('trang_thai', 'con_hieu_luc')
            ->where('ngay_bat_dau', '<=', now())
            ->where('ngay_ket_thuc', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Mã khuyến mãi không hợp lệ hoặc đã hết hạn!',
                'total' => $total
            ], 200);
        }

        $discount = $coupon->loai === 'phan_tram' ? ($total * $coupon->gia_tri) / 100 : $coupon->gia_tri;
        $discount = min($discount, $total);
        $newTotal = $total - $discount;

        session()->put('coupon', [
            'id' => $coupon->id,
            'ma_code' => $coupon->ma_code,
            'discount' => $discount,
            'total' => $newTotal
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Áp dụng mã khuyến mãi thành công!',
            'discount' => $discount,
            'total' => $newTotal
        ], 200);
    }
}
