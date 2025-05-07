@extends('admin.admin')

@section('title', 'Sửa Danh Mục')
@section('description', '')
@section('content')

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

         <div class="row">
            
              <div class="col-xl-12 col-lg-8 ">
                    <form action="{{ route('admin.categories.update', $category->id)}}" method="post" id="formCategory"  enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">General Information</h4>
                                </div>
                                <div id="uploaded-files3"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <label for="product-name" class="form-label">Category</label>
                                             <div class="col-lg-6">       
                                                  <input type="text" id="category-name mb-1" name="ten_danh_muc_vi" class="form-control mb-2" placeholder="Tên danh mục" value="{{ $category->ten_danh_muc_vi }}">   
                                                  @error('ten_danh_muc_vi')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror                                      
                                             </div>
                                             
                                             <div class="col-lg-6">
                                                  <input type="text" id="category-name" name="ten_danh_muc_en" class="form-control mb-2" placeholder="Tên danh mục English" value="{{ $category->ten_danh_muc_en }}">
                                                  {{-- @error('ten_san_pham_en')
                                                  <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror    --}}
                                             </div>
                                   </div>
                                   <div class="row">
                                             <div class="col-lg-6">
                                                  <div class="mb-3">
                                                       <label for="category-name" class="form-label mt-1">Slug</label>
                                                       <input type="text" id="category-name" name="slug" class="form-control" placeholder="slug" value="{{ $category->slug }}">
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

</div>
<script>
     function resetForm() {
         document.getElementById('formCategory').reset();
     }
</script>
@endsection
