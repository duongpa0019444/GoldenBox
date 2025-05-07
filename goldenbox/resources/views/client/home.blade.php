@extends('client.client')

@section('title', 'Home')
@section('description', '')
@section('content')
    <style>
        .product-card {
            margin-bottom: 20px;
        }
        .cart-icon {
            cursor: pointer;
            font-size: 24px;
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
        .cart-item-details p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .quantity-control button {
            width: 30px;
            height: 30px;
            padding: 0;
            font-size: 16px;
        }
        .quantity-control input {
            width: 40px;
            text-align: center;
        }
        .cart-item-price {
            font-weight: bold;
            color: #333;
        }
        .promo-banner {
            background-color: #ffecd1;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 14px;
            color: #d32f2f;
            text-align: center;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
        }
        .checkout-btn {
            background-color: #d32f2f;
            color: white;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .modal-footer a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
    <div class="container d-flex justify-content-center align-item-center">
        <div class="container mt-5">
            <h1>Trang chủ</h1>
            <div class="d-flex justify-content-end mb-3">
                <div class="cart">
                    <span class="cart-icon" data-bs-toggle="modal" data-bs-target="#cartModal">🛒</span>
                    <span id="cartCount">{{ count(session('cart', [])) }}</span>
                </div>
            </div>
            <div class="row" id="productList">
                @foreach ($data as $prd)
                    <div class="col-md-4 product-card">
                        <div class="card">
                            <img src="{{ $prd->anh_chinh }}" width="100" class="card-img-top"
                                alt="{{ $prd->ten_san_pham_vi }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $prd->ten_san_pham_vi }}</h5>
                                <p class="card-text">Giá: {{ number_format($prd->gia_goc_vi, 0, ',', '.') }} VNĐ</p>
                                <p class="card-text">Số lượng: {{ $prd->so_luong }}</p>
                                <form action="{{ route('add.to.cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $prd->id }}">
                                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Giỏ hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('cart') && count(session('cart')) > 0)
                            @php
                                $total = 0;
                            @endphp
                            @foreach (session('cart') as $id => $item)
                                @php
                                    $subtotal = $item['price_vi'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <div class="cart-item" data-product-id="{{ $id }}">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name_vi'] }}">
                                    <div class="cart-item-details">
                                        <h6>{{ $item['name_vi'] }}</h6>
                                        <div id="quantityControl" class="quantity-control">
                                            <button class="btn btn-outline-secondary btn-decrease"
                                                data-product-id="{{ $id }}">-</button>
                                            <input type="text" value="{{ $item['quantity'] }}" readonly
                                                class="quantity-input">
                                            <button class="btn btn-outline-secondary btn-increase"
                                                data-product-id="{{ $id }}">+</button>
                                        </div>
                                    </div>
                                    <div class="cart-item-price">
                                        <span class="shopping-cart__subtotal"
                                            data-subtotal="{{ $subtotal }}">{{ number_format($subtotal, 0, ',', '.') }}đ</span>
                                    </div>
                                    <button class="btn btn-danger btn-delete" data-product-id="{{ $id }}">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            @endforeach
                            <div class="total-price">
                                TỔNG TIỀN: <span id="cart-total">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                        @else
                            <p>Giỏ hàng của bạn đang trống.</p>
                        @endif
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        @if (session('cart') && count(session('cart')) > 0)
                            <form action="{{ route('clear.cart') }}" method="POST" class="ms-2">
                                @csrf
                                <button class="btn btn-danger">Xóa giỏ hàng</button>
                            </form>
                            <a href="{{ route('checkout') }}" class="btn checkout-btn">THANH TOÁN</a>
                        @else
                            <button class="btn checkout-btn" disabled>THANH TOÁN</button>
                        @endif
                        <a href="#">Nhận khuyến mãi dành cho bạn</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-decrease').on('click', function(e) {
                e.preventDefault();
                updateQuantity($(this), -1);
            });

            $('.btn-increase').on('click', function(e) {
                e.preventDefault();
                updateQuantity($(this), 1);
            });

            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                    deleteItem($(this));
                }
            });

            // Hàm định dạng số tiền
            function numberFormat(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Hàm cập nhật tổng tiền giỏ hàng
            function updateCartTotals() {
                let total = 0;
                $('.shopping-cart__subtotal').each(function() {
                    total += parseInt($(this).data('subtotal'));
                });
                $('#cart-total').text(numberFormat(total) + 'đ');
            }

            function updateQuantity(button, change) {
                let productId = button.data('product-id');
                let quantityInput = button.siblings('.quantity-input');
                let currentQuantity = parseInt(quantityInput.val());
                let newQuantity = currentQuantity + change;
                let cartItem = button.closest('.cart-item');
                let subtotalSpan = cartItem.find('.shopping-cart__subtotal');

                if (newQuantity < 1) {
                    alert('Số lượng không thể nhỏ hơn 1!');
                    return;
                }

                $.ajax({
                    url: "{{ route('update.cart') }}",
                    type: "POST",
                    data: {
                        product_id: productId,
                        quantity: newQuantity,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Update Success Response:', response);
                        if (response.success) {
                            quantityInput.val(newQuantity);
                            subtotalSpan.text(numberFormat(response.subtotal) + 'đ');
                            subtotalSpan.data('subtotal', response.subtotal);
                            $('#cart-total').text(numberFormat(response.total) + 'đ');
                            $('#cartCount').text(response.cart_count);
                            updateCartTotals();
                        } else {
                            alert(response.message || 'Cập nhật giỏ hàng thất bại!');
                        }
                    },
                    error: function(xhr) {
                        console.log('Update Error Status:', xhr.status);
                        console.log('Update Error Response:', xhr.responseText);
                        try {
                            let jsonMatch = xhr.responseText.match(/{.*}/);
                            if (jsonMatch) {
                                let response = JSON.parse(jsonMatch[0]);
                                console.log('Update Parsed JSON:', response);
                                if (response.success) {
                                    quantityInput.val(newQuantity);
                                    subtotalSpan.text(numberFormat(response.subtotal) + 'đ');
                                    subtotalSpan.data('subtotal', response.subtotal);
                                    $('#cart-total').text(numberFormat(response.total) + 'đ');
                                    $('#cartCount').text(response.cart_count);
                                    updateCartTotals();
                                } else {
                                    alert(response.message || 'Cập nhật giỏ hàng thất bại!');
                                }
                            } else {
                                throw new Error('No JSON found in response');
                            }
                        } catch (e) {
                            console.log('Update Parse Error:', e.message);
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                        }
                    }
                });
            }

            function deleteItem(button) {
                let productId = button.data('product-id');
                let cartItem = button.closest('.cart-item');

                $.ajax({
                    url: "{{ route('delete.cart') }}",
                    type: "POST",
                    data: {
                        product_id: productId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Delete Success Response:', response);
                        if (response.success) {
                            cartItem.remove();
                            $('#cart-total').text(numberFormat(response.total) + 'đ');
                            $('#cartCount').text(response.cart_count);
                            updateCartTotals();
                            alert('Sản phẩm đã được xóa khỏi giỏ hàng!');
                            // Kiểm tra nếu giỏ hàng rỗng
                            if (response.cart_count === 0) {
                                $('.modal-body').html('<p>Giỏ hàng của bạn đang trống.</p>');
                                $('.checkout-btn').prop('disabled', true);
                            }
                        } else {
                            alert(response.message || 'Xóa sản phẩm thất bại!');
                        }
                    },
                    error: function(xhr) {
                        // console.log('Delete Error Status:', xhr.status);
                        // console.log('Delete Error Response:', xhr.responseText);
                        try {
                            let jsonMatch = xhr.responseText.match(/{.*}/);
                            if (jsonMatch) {
                                let response = JSON.parse(jsonMatch[0]);
                                console.log('Delete Parsed JSON:', response);
                                if (response.success) {
                                    cartItem.remove();
                                    $('#cart-total').text(numberFormat(response.total) + 'đ');
                                    $('#cartCount').text(response.cart_count);
                                    updateCartTotals();
                                    alert('Sản phẩm đã được xóa khỏi giỏ hàng!');
                                    // Kiểm tra nếu giỏ hàng rỗng
                                    if (response.cart_count === 0) {
                                        $('.modal-body').html('<p>Giỏ hàng của bạn đang trống.</p>');
                                        $('.checkout-btn').prop('disabled', true);
                                    }
                                } else {
                                    alert(response.message || 'Xóa sản phẩm thất bại!');
                                }
                            } else {
                                throw new Error('No JSON found in response');
                            }
                        } catch (e) {
                            console.log('Delete Parse Error:', e.message);
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                        }
                    }
                });
            }

            // Đảm bảo modal đóng đúng cách
            document.addEventListener('DOMContentLoaded', function() {
                const cartModal = document.getElementById('cartModal');
                cartModal.addEventListener('hidden.bs.modal', function() {
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                });

                // Mở modal khi nhấn vào icon giỏ hàng
                document.querySelector('.cart-icon').addEventListener('click', function() {
                    const modal = new bootstrap.Modal(cartModal);
                    modal.show();
                });
            });
        });
    </script>
@endsection