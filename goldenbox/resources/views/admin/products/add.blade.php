@extends('admin.admin')


@section('title', 'Trang admin')
@section('description', '')
@section('content')
<style>
     .ck-editor__editable {
         min-height: 300px !important; /* Tăng từ mặc định ~200px lên 400px */
         border-radius: 0.375rem !important; /* Tăng độ bo góc */    
     }
 </style>

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

         <div class="row">
              <div class="col-xl-4 col-lg-4">
                   <div class="card">
                              <div class="card-body">
                                   <!-- FORM ẢNH - Dropzone -->
                                   <label class="form-label mb-1 fw-bolder">Nhập ảnh chính</label>
                                   <form method="post" action="{{ route('admin.upload.image') }}" 
                                   enctype="multipart/form-data"
                                   class="dropzone" id="imageDropzone">
                                   <div class="dz-message needsclick">
                                        <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                        <h4 class="mt-4"> Kéo ảnh hoặc <span class="text-primary">click vào </span> để tải ảnh lên</h4>
                                        <span class="text-muted fs-8">
                                             1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                        </span>
                                   </div>    
                                   @csrf
                              </form>
                              <label class="form-label mt-1 mb-1 fw-bolder">Nhập ảnh phụ</label>
                              <form method="post" action="{{ route('admin.upload.image') }}" 
                                   enctype="multipart/form-data"
                                   class="dropzone" id="imageDropzone2">
                                   @csrf
                                   <div class="dz-message needsclick">
                                        <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                        <h4 class="mt-4"> Kéo ảnh hoặc <span class="text-primary">click vào </span> để tải ảnh lên</h4>
                                        <span class="text-muted fs-8">
                                             1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                        </span>
                                   </div>
                              </form>
                              <!-- Hidden chứa tên ảnh sau khi upload -->
                        </div>                                  
                   </div>
              </div>

              <div class="col-xl-8 col-lg-8 ">

                <form action="{{ route('admin.product.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                   
                   <div class="card">
                        <div class="card-header">
                             <h4 class="card-title">Product Information</h4>
                        </div>
                        <div id="uploaded-files"></div>
                        <div id="uploaded-files2"></div>
                        <di class="card-body">
                        
                             <div class="row">
                                   <label for="product-name" class="form-label">Product Name</label>
                                        <div class="col-lg-6">       
                                             <input type="text" id="product-name mb-1" name="ten_san_pham_vi" class="form-control mb-2" placeholder="Tên sản phẩm" value="">   
                                             @error('ten_san_pham_vi')
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror                                      
                                        </div>
                                        
                                        <div class="col-lg-6">
                                             <input type="text" id="product-name" name="ten_san_pham_en" class="form-control mb-2" placeholder="Tên sản phẩm English" value="">
                                             {{-- @error('ten_san_pham_en')
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror    --}}
                                        </div>
                                   
                              </div>
                              <div class="row">
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="product-categories" class="form-label">Product Categories</label>
                                             <select class="form-control mt-1"  name="id_danh_muc">
                                             @foreach ($catalogies as $catalogie )
                                                 <option value="{{$catalogie->id}}">{{$catalogie->ten_danh_muc_vi}}</option>
                                             @endforeach    
                                             </select>  
                                             @error('id_danh_muc')
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror   
                                        </div>
                                </div>
                                        <div class="col-lg-6">
                                             <div class="mb-3">
                                                  <label for="product-name" class="form-label mt-1">Slug</label>
                                                  <input type="text" id="product-name" name="slug" class="form-control" placeholder="slug" value="">
                                             </div>
                                        </div>
                              </div>    
                            
                             <div class="row">
                              <div class="col-lg-4">
                                        <div class="mb-3">
                                             <label for="product-weight" class="form-label">Số lượng sản phẩm</label>
                                             <input type="text" id="product-weight" class="form-control" name="so_luong" placeholder="Số lượng sản phẩm">
                                             @error('so_luong')
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror   
                                        </div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12">
                                        <div class="mb-3">
                                             <label for="description" class="form-label">Mô tả ngắn</label>
                                             <textarea class="form-control bg-light-subtle" id="description" name="mo_ta_vi" rows="2" placeholder="Mô tả ngắn"></textarea>
                                             <textarea class="form-control bg-light-subtle mt-1" id="description" name="mo_ta_en" rows="2" placeholder="Mô tả ngắn English"></textarea>
                                             @error('ten_san_pham_vi','ten_san_pham_en')
                                             <div class="alert alert-danger">{{ $message }}</div>
                                             @enderror   
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-12">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <div class="mb-3">
                                             <textarea class="form-control bg-light-subtle mb-3" id="mo_ta_vi" name="mo_ta_vi" rows="7" placeholder="Mô tả VietNammese"></textarea>
                                        </div>
                                        <div class="mb-3">
                                             <textarea class="form-control bg-light-subtle mt-3" id="mo_ta_en" name="mo_ta_en" rows="7" placeholder="Mô tả English"></textarea>
                                        </div>
                                        @error('mo_ta_vi','mo_ta_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                   </div>
                   <div class="card">
                        <div class="card-header">
                             <h4 class="card-title">Pricing Details</h4>
                        </div>
                        <div class="card-body">
                             <div class="row justify-content-around">
                                  <div class="col-lg-4">
                                            <label for="product-price" class="form-label">Giá</label>
                                            <div class="input-group mb-3">
                                                 <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                                 <input type="number" id="product-price" class="form-control" name="gia_goc_vi" placeholder="Giá Vnd" value="">
                                                 <input type="number" id="product-price" class="form-control" name="gia_goc_en" placeholder="Giá USD" value="">
                                                 @error('gia_goc_vi','gia_goc_en')
                                                 <div class="alert alert-danger">{{ $message }}</div>
                                                 @enderror   
                                            </div>
                                  </div>
                                  <div class="col-lg-4">
                                            <label for="product-discount" class="form-label">Discount</label>
                                            <div class="input-group mb-3">
                                                 <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                                 <input type="number" id="product-discount" class="form-control" placeholder="000" value="30">
                                            </div>
                                  </div>
                             </div>
                        </div>
                   </div>
                   <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                             <div class="col-lg-2">
                              <button type="button" class="btn btn-outline-secondary w-100" onclick="resetForm()">Reset</button>
                             </div>
                             <div class="col-lg-2">
                                  <button type="submit" class="btn btn-primary w-100">Save</button>
                             </div>
                        </div>
                        @if (session('success'))
                         <div class="alert alert-success">
                         {{ session('success') }}
                         </div>
                         @endif

                         {{-- Thông báo lỗi --}}
                         @if (session('error'))
                         <div class="alert alert-danger">
                         {{ session('error') }}
                         </div>
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
               </form>
              </div>
         </div>

    </div>
    <!-- End Container Fluid -->
    <script>
     function resetForm() {
         document.getElementById('myAwesomeDropzone').reset();
     }
     
    ClassicEditor
        .create(document.querySelector('#mo_ta_vi'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#mo_ta_en'),)
        .catch(error => {
            console.error(error);
        });
     document.addEventListener("DOMContentLoaded", function () {
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("#imageDropzone", {
        url: "/upload-image",
        paramName: "file",
        maxFilesize: 5,
        maxFiles: 1,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Xóa ảnh",

        init: function() {
            // Xử lý khi vượt quá số lượng file
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
                alert("Chỉ được tải lên 1 ảnh!");
            });
        },


        success: function(file, response) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "anh_chinh";
            input.value = response.filename;
            document.getElementById("uploaded-files").appendChild(input);
        },

        removedfile: function(file) {
            if (file.xhr) {
                const response = JSON.parse(file.xhr.response);
                fetch("/delete-image", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ filename: response.filename })
                });
            }

            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });
    var myDropzone2 = new Dropzone("#imageDropzone2", {
        url: "/upload-image",
        paramName: "file",
        maxFilesize: 5,
        maxFiles: 4,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "Xóa ảnh",

        init: function() {
            // Xử lý khi vượt quá số lượng file
            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
                alert("Chỉ được tải lên 4 ảnh!");
            });
        },


        success: function(file, response) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "hinh_anh[]";
            input.value = response.filename;
            document.getElementById("uploaded-files2").appendChild(input);
        },

        removedfile: function(file) {
            if (file.xhr) {
                const response = JSON.parse(file.xhr.response);
                fetch("/delete-image", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ filename: response.filename })
                });
            }

            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }
    });
});
     </script>

@endsection
