@extends('admin.admin')


@section('title', 'Trang admin')
@section('description', '')
<script></script>
@section('content')

    <style>
        .card:hover {
            box-shadow: 0 0 3px gray;
        }

        .text-reset:hover {
            color: #e6612a !important;
            transform: translateX(2px);
            transition: ease-in-out 0.2s;
        }

        .dropdown-toggle::after {
            display: none;
            /* Ẩn icon mặc định */
        }
    </style>
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-fluid">

            <!-- Start here.... -->
            <div class="row mt-2">
                <div class="col-xxl-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-xs-12" data-aos="fade-right" data-aos-duration="800">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="avatar-md bg-soft-primary rounded">
                                                <iconify-icon icon="solar:cart-5-bold-duotone"
                                                    class="avatar-title fs-32 text-primary"></iconify-icon>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate">Tổng số đơn chưa giao!</p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_don_chua_giao }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                        <div class="col-lg-12 col-md-6 col-xs-12" data-aos="fade-right" data-aos-duration="1500">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="avatar-md bg-soft-success rounded">
                                                <i class="bx bx-dollar-circle avatar-title text-success fs-24"></i>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate">Số đơn hàng đã bán! </p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_don_da_ban }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">

                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end col -->

                <div class="col-xxl-8" data-aos="fade-up" data-aos-duration="1500">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-item-center">
                                <h4 class="card-title">Thống kê doanh thu theo</h4>
                                <div class="col-lg-4">
                                    <form>
                                        <select class="form-control" id="product-categories" data-choices
                                            data-choices-groups data-placeholder="Select Categories" name="where">
                                            <option value="">Đơn Hàng đã bán</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->ten_san_pham_vi }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-light">Ngày</button>
                                    <button type="button" class="btn btn-sm btn-outline-light">Tuần</button>
                                    <button type="button" class="btn btn-sm btn-outline-light active">Tháng</button>
                                </div>
                            </div> <!-- end card-title-->

                            <div dir="ltr">
                                <div id="dash-performance-chart" class="apex-charts"></div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->


            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-xs-12" data-aos="zoom-in-up" data-aos-duration="800">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div
                                                class="avatar-md bg-success rounded-circle d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="line-md:clipboard-list"
                                                    class="text-light fs-24"></iconify-icon>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate fs-15">Tổng danh mục! </p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_danh_muc }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">

                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-lg-3 col-md-6 col-xs-12" data-aos="zoom-in-up" data-aos-duration="800">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div
                                                class="avatar-md bg-success rounded-circle d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="line-md:cookie" class="text-light fs-24"></iconify-icon>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate fs-15">Tổng sản phẩm! </p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_san_pham }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">

                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-lg-3 col-md-6 col-xs-12" data-aos="zoom-in-up" data-aos-duration="800">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div
                                                class="avatar-md bg-success rounded-circle d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="line-md:calendar"
                                                    class="text-light fs-24"></iconify-icon>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate fs-15">Mã khuyến mãi! </p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_ma_khuyen_mai }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">

                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-lg-3 col-md-6 col-xs-12" data-aos="zoom-in-up" data-aos-duration="800">
                            <div class="card overflow-hidden">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-3">
                                            <div
                                                class="avatar-md bg-success rounded-circle d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="line-md:clipboard-list"
                                                    class="text-light fs-24"></iconify-icon>

                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-9 text-end">
                                            <p class="text-muted mb-0 text-truncate fs-15">Tổng bài viết! </p>
                                            <h3 class="text-dark mt-1 mb-0">{{ $countData->tong_bai_viet }}</h3>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </div> <!-- end card body -->
                                <div class="card-footer py-2 bg-light bg-opacity-50">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="#!" class="text-reset fw-semibold fs-15">Xem Thêm</a>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                    </div> <!-- end row -->
                </div> <!-- end col -->



                <div class="row ">
                    <div class="col-xl-12 ">
                        <div class="card" data-aos="fade-up" data-aos-duration="800">
                            <div class="d-flex card-header justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title">Đơn Hàng Mới (Chưa gọi)</h4>
                                </div>
                                <!-- App Search-->
                                <!-- HTML -->
                                <form class="app-search d-none d-md-block ms-2" onsubmit="return false;">
                                    <div class="position-relative">
                                        <input type="text" id="keyword" class="form-control"
                                            placeholder="Search..." autocomplete="off" value="">

                                        <button type="button" id="submitSearch"
                                            class="btn btn-link position-absolute end-0 top-0 mt-1 me-2">
                                            <iconify-icon icon="solar:magnifer-linear"
                                                class="search-widget-icon"></iconify-icon>
                                        </button>
                                    </div>
                                </form>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-hover table-centered fs-15">
                                        <thead class="bg-light-subtle">
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Ngày tạo</th>
                                                <th>Khách hàng</th>

                                                <th>Tổng tiền</th>
                                                <th>Thanh toán</th>
                                                <th>Số lượng mặt hàng</th>
                                                <th>Ghi chú</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders-body">
                                            @foreach ($ordersNews as $ordersNew)
                                                <tr>
                                                    <td>#{{ $ordersNew->id }}</td>
                                                    <td>{{ $ordersNew->created_at->format('d/m/Y H:i') }}</td>

                                                    <td>
                                                        <a href="#!"
                                                            class="link-primary fw-medium">{{ $ordersNew->ho_ten }}</a>
                                                    </td>

                                                    <td>{{ $ordersNew->tong_tien_formatted }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-light text-dark px-2 py-1 fs-13">{{ $ordersNew->trang_thai_thanh_toan }}</span>
                                                    </td>
                                                    <td>{{ $ordersNew->chi_tiet_don_hangs_count }}</td>
                                                    <td>{{ $ordersNew->ghi_chu }}</td>
                                                    <td>
                                                        <span
                                                            class="badge border border-secondary text-secondary px-2 py-1 fs-13">{{ $ordersNew->trang_thai_giao_hang }}</span>
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-light btn-sm dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown">
                                                                Thao tác <iconify-icon icon="tabler:caret-down-filled"
                                                                    class="ms-1"></iconify-icon>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><iconify-icon
                                                                            icon="solar:eye-broken"
                                                                            class="me-1"></iconify-icon> Xem</a></li>
                                                                <li><a class="dropdown-item" href="#"><iconify-icon
                                                                            icon="solar:pen-2-broken"
                                                                            class="me-1"></iconify-icon> Sửa</a></li>
                                                                <li><a class="dropdown-item text-danger"
                                                                        href="#"><iconify-icon
                                                                            icon="solar:trash-bin-minimalistic-2-broken"
                                                                            class="me-1"></iconify-icon> Xóa</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- end table-responsive -->
                            </div>

                            <div id="pagination-wrapper" class="card-footer border-top">
                                {{ $ordersNews->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- End Container Fluid -->
        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->



        <script>
            //Phân trang-------------------------------
            const wrapper = document.getElementById('pagination-wrapper');
            wrapper.addEventListener('click', function(event) {
                const target = event.target;

                // Kiểm tra nếu phần tử được click là <a> (nút phân trang)
                if (target.tagName === 'A') {
                    event.preventDefault();

                    const url = target.getAttribute('href');
                    console.log("Clicked pagination link:", url);

                    loadOrders(url);

                }

            });


            async function loadOrders(url) {


                try {
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const data = await response.json();
                    console.log(data);
                    //Thay đổi nút chuyển trang
                    document.getElementById('pagination-wrapper').innerHTML = data.pagination;

                    //Thay đổi nội dung tbody
                    const tbody = document.getElementById('orders-body');
                    tbody.innerHTML = ''; // clear cũ
                    data.data.forEach(order => {
                        const row = `
                            <tr>
                                <td>#${order.id}</td>
                                <td>${formatDateTime(order.created_at)}</td>
                                <td>
                                    <a href="#!" class="link-primary fw-medium">${order.ho_ten}</a>
                                </td>
                                <td>${order.tong_tien_formatted}</td>
                                <td>
                                    <span class="badge bg-light text-dark px-2 py-1 fs-13">${order.trang_thai_thanh_toan}</span>
                                </td>
                                <td>${order.chi_tiet_don_hangs_count}</td>
                                <td>${order.ghi_chu}</td>
                                <td>
                                    <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">${order.trang_thai_giao_hang}</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Thao tác <iconify-icon icon="tabler:caret-down-filled" class="ms-1"></iconify-icon>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><iconify-icon icon="solar:eye-broken" class="me-1"></iconify-icon> Xem</a></li>
                                            <li><a class="dropdown-item" href="#"><iconify-icon icon="solar:pen-2-broken" class="me-1"></iconify-icon> Sửa</a></li>
                                            <li><a class="dropdown-item text-danger" href="#"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="me-1"></iconify-icon> Xóa</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                } catch (error) {
                    console.error('Lỗi khi tải đơn hàng:', error);
                }
            }




            //TÌM KIẾM----------------------------------

            const searchInput = document.getElementById('keyword');
            const searchIcon = document.getElementById('submitSearch');

            // Lắng nghe sự kiện keydown trên input
            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Ngăn không cho form bị submit
                    searchIcon.click(); // Trigger sự kiện click khi nhấn Enter
                }
            });

            // Sự kiện click vào button
            searchIcon.addEventListener('click', () => {
                const searchTerm = searchInput.value.trim();

                if (searchTerm) {
                    const urlsearch = `/admin/orders/search?search=${encodeURIComponent(searchTerm)}`;

                    loadOrders(urlsearch);
                } else {
                    //lấy url hiện tại và gọi loadorders
                    const currentUrl = window.location.href;
                    loadOrders(currentUrl);
                }
            });

            function formatDateTime(datetime) {
                if (!datetime) return '';
                const date = new Date(datetime);
                return date.toLocaleString('vi-VN'); // hoặc format theo ý muốn
            }
        </script>
    @endsection
