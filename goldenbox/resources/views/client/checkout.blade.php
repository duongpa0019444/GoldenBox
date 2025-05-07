@extends('client.client')

@section('title', 'Thanh Toán')
@section('description', 'Trang thanh toán đơn hàng')
@section('content')
    <style>
        .checkout-container {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .checkout-form,
        .cart-summary {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .checkout-form h4,
        .cart-summary h4 {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            margin-right: 15px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-details h6 {
            margin: 0;
            font-size: 16px;
        }

        .cart-item-price {
            font-weight: bold;
            color: #333;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 15px;
            text-align: right;
        }

        .place-order-btn {
            background-color: #d32f2f;
            color: white;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 20px;
        }

        .coupon-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .coupon-section input {
            flex-grow: 1;
        }

        .apply-coupon-btn {
            background-color: #007bff;
            color: white;
        }

        .discount-info {
            color: green;
            font-weight: bold;
            margin-top: 10px;
            display: none;
        }
    </style>

    <div class="container checkout-container">
        <h1>Thanh Toán</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($cart))
            <div class="alert alert-warning">
                Giỏ hàng của bạn đang trống. <a href="{{ route('home') }}">Tiếp tục mua sắm</a>
            </div>
        @else
            <div class="row">
                <!-- Bên trái: Danh sách sản phẩm trong giỏ hàng -->
                <div class="col-md-6 cart-summary">
                    <h4>Giỏ Hàng Của Bạn</h4>
                    @foreach ($cart as $id => $item)
                        @php
                            $subtotal = $item['price_vi'] * $item['quantity'];
                        @endphp
                        <div class="cart-item">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name_vi'] }}">
                            <div class="cart-item-details">
                                <h6>{{ $item['name_vi'] }}</h6>
                                <p>Số lượng: {{ $item['quantity'] }}</p>
                                <p>Giá: {{ number_format($item['price_vi'], 0, ',', '.') }}đ</p>
                            </div>
                            <div class="cart-item-price">
                                {{ number_format($subtotal, 0, ',', '.') }}đ
                            </div>
                        </div>
                    @endforeach
                    <div class="total-price">
                        <div class="discount-info" id="discount-info">
                            Giảm giá: <span id="discount-amount">0</span>đ
                        </div>
                        {{-- VAT (10%): <span id="vat-price">{{ number_format($vat, 0, ',', '.') }}</span>đ<br> --}}
                        TỔNG TIỀN: <span id="total-price">{{ number_format($total, 0, ',', '.') }}</span>đ
                    </div>
                </div>

                <!-- Bên phải: Form thông tin khách hàng -->
                <div class="col-md-6 checkout-form">
                    <h4>Thông Tin Thanh Toán</h4>
                    <form action="{{ route('place.order') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ho_ten" class="form-label">Họ và Tên *</label>
                            <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                                value="{{ old('ho_ten') }}" required>
                            @error('ho_ten')
                                <div class="text-danger">{{ $message }}</div>name
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số Điện Thoại *</label>
                            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai"
                                value="{{ old('so_dien_thoai') }}" required>
                            @error('so_dien_thoai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dia_chi" class="form-label">Địa Chỉ Giao Hàng *</label>
                            <textarea class="form-control" id="address" name="dia_chi" rows="3" required>{{ old('dia_chi') }}</textarea>
                            @error('dia_chi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ghi" class="form-label">Ghi Chú (Tùy Chọn)</label>
                            <textarea class="form-control" id="ghi" name="ghi" rows="3">{{ old('ghi') }}</textarea>
                            @error('ghi')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phuong_thuc_thanh_toan" class="form-label">Phương Thức Thanh Toán *</label>
                            <select class="form-control" id="phuong_thuc_thanh_toan" name="phuong_thuc_thanh_toan" required>
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="bank">Chuyển khoản ngân hàng</option>
                                <option value="momo">Ví Momo</option>
                            </select>
                            <div id="bank-info" style="display: none; margin-top: 10px;">
                                <p>Thông tin tài khoản: Ngân hàng ABC - Số TK: 123456789 - Chủ TK: Công ty XYZ</p>
                            </div>
                            @error('phuong_thuc_thanh_toan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="coupon-section">
                            <input type="text" class="form-control" id="coupon_code" placeholder="Nhập mã khuyến mãi">
                            <button type="button" class="btn apply-coupon-btn">Áp dụng</button>
                        </div>

                        <button type="submit" class="btn place-order-btn">ĐẶT HÀNG</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    @endsection
    
    @push('scripts')
    <script>
        $('#phuong_thuc_thanh_toan').on('change', function() {
            if ($(this).val() === 'bank') {
                $('#bank-info').show();
            } else {
                $('#bank-info').hide();
            }
        });

        $(document).ready(function() {
            function numberFormat(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            $('.apply-coupon-btn').on('click', function() {
                let couponCode = $('#coupon_code').val();
                if (!couponCode) return alert('Vui lòng nhập mã khuyến mãi!');

                $.ajax({
                    url: "{{ route('apply.coupon') }}",
                    type: "POST",
                    data: {
                        coupon_code: couponCode,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Áp mã thành công:', response); // Debug
                        $('#discount-info').toggle(!!response.success);
                        $('#discount-amount').text(numberFormat(response.discount || 0));
                        $('#total-price').text(numberFormat(response.total || 0));
                        // alert(response.message || 'Lỗi không xác định');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText); // Debug
                        alert('Lỗi server: ' + (xhr.responseText || 'Thử lại!'));
                    }
                });
            });
        });
        
    </script>
    @endpush

