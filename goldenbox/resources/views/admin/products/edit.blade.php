@extends('admin.admin')

@section('title', 'Trang admin')
@section('description', '')
@section('content')
<style>
    .ck-editor__editable {
        min-height: 300px !important;
        border-radius: 0.375rem !important;
    }
</style>

<div class="page-content">
    <div class="container-xxl">
        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" id="productForm">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <label for="fileInput" style="cursor: pointer;">
                                <img id="previewImage" src="{{ asset('admin/images/products/' . $product->anh_chinh) }}" alt="Ảnh sản phẩm" class="img-fluid rounded bg-light" style="width: 100%; object-fit: cover;">
                            </label>
                            <input type="file" name="anh_chinh" id="fileInput" class="d-none" accept="image/*">
                            <div id="uploaded-files"></div>
                            <p class="fw-bolder mt-2 text-center">Ảnh chính</p>

                            <button type="submit" class="btn btn-primary w-100 mt-3 d-xl-none">Lưu thay đổi</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                                @foreach ($chitiets as $index => $chitiet)
                                    <label for="fileInput{{ $index }}" style="cursor: pointer;">
                                        <img id="previewImage{{ $index }}" src="{{ asset('admin/images/products/' . $chitiet->hinh_anh) }}"
                                            alt="Ảnh sản phẩm" class="img-fluid rounded bg-light preview-image"
                                            style="width: 100%; object-fit: cover;">
                                    </label>
                            
                                    <input type="file" name="hinh_anh[{{ $index }}]" id="fileInput{{ $index }}"
                                        class="d-none file-input" accept="image/*">
                            
                                    <input type="hidden" name="old_images[]" value="{{ $chitiet->hinh_anh }}">
                            
                                    <p class="fw-bolder mt-2 text-center">Ảnh phụ {{ $index + 1 }}</p>
                                @endforeach
                            
                                {{-- Chỉ hiển thị nút thêm nếu số ảnh hiện tại < 4 --}}
                                @if (count($chitiets) < 4)
                                    <label for="addImage" class="btn btn-secondary mt-3 w-100">+ Thêm ảnh phụ mới</label>
                                    <input type="file" name="hinh_anh_new[]" id="addImage" class="d-none" multiple accept="image/*">
                                @endif
                            
                                <button type="submit" class="btn btn-primary w-100 mt-3 d-xl-none">Lưu thay đổi</button>
                            </div>
                    </div>
                </div>
                

                <!-- Right Column -->
                <div class="col-xl-9 col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header"><h4 class="card-title">Product Information</h4></div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <label for="ten_san_pham_vi" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="ten_san_pham_vi" class="form-control" placeholder="Tên sản phẩm" value="{{ $product->ten_san_pham_vi }}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ten_san_pham_en" class="form-label">Product Name (English)</label>
                                    <input type="text" name="ten_san_pham_en" class="form-control" placeholder="Tên sản phẩm English" value="{{ $product->ten_san_pham_en }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <label for="id_danh_muc" class="form-label">Product Categories</label>
                                    <select name="id_danh_muc" class="form-control">
                                        @foreach ($catalogies as $catalogie)
                                            <option value="{{ $catalogie->id }}" {{ $product->id_danh_muc == $catalogie->id ? 'selected' : '' }}>{{ $catalogie->ten_danh_muc_vi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-4">
                                    <label for="so_luong" class="form-label">Số lượng</label>
                                    <input type="number" name="so_luong" class="form-control" value="{{ $product->so_luong }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="mo_ta_vi" class="form-label">Mô tả ngắn</label>
                                <textarea class="form-control" name="mo_ta_vi" rows="2">{{ $product->mo_ta_ngan_vi }}</textarea>
                                <textarea class="form-control mt-2" name="mo_ta_en" rows="2">{{ $product->mo_ta_ngan_en }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control" id="mo_ta_vi" name="mo_ta_vi" rows="6">{{ $product->mo_ta_vi }}</textarea>
                                <label class="form-label mt-1">Mô tả English</label>
                                <textarea class="form-control mt-2" id="mo_ta_en" name="mo_ta_en" rows="6">{{ $product->mo_ta_en }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header"><h4 class="card-title">Pricing Details</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="gia_goc_vi" class="form-label">Giá VND</label>
                                    <input type="number" name="gia_goc_vi" class="form-control" value="{{ $product->gia_goc_vi }}">
                                </div>
                                <div class="col-lg-4">
                                    <label for="gia_goc_en" class="form-label">Giá USD</label>
                                    <input type="number" name="gia_goc_en" class="form-control" value="{{ $product->gia_goc_en }}">
                                </div>
                                <div class="col-lg-4">
                                    <label for="discount" class="form-label">Discount (%)</label>
                                    <input type="number" name="discount" class="form-control" value="{{ $product->discount ?? 0 }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit buttons -->
                    <div class="text-end mb-5">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');

        if (file && preview) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.querySelectorAll('.file-input').forEach((input, index) => {
        input.addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage' + index);

            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    ClassicEditor.create(document.querySelector('#mo_ta_vi')).catch(error => console.error(error));
    ClassicEditor.create(document.querySelector('#mo_ta_en')).catch(error => console.error(error));
</script>
@endsection