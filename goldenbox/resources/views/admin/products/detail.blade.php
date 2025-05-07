@extends('admin.admin')


@section('title', 'Trang admin')
@section('description', '')
@section('content')

<div class="page-content">

    <!-- Start Container Fluid -->
    <div class="container-xxl">

        <div class="row">
             <div class="col-lg-4">
                  <div class="card">
                       <div class="card-body">
                            <!-- Crossfade -->
                            <div class="row mb-3">
                            <div class="col-12">
                              <img id="mainImage" src="{{ asset('admin/images/products/'.$product->anh_chinh) }}" class="img-fluid w-100 rounded" alt="Ảnh chính">
                            </div>
                          </div>
                        
                          <!-- Row 2: 4 ảnh phụ -->
                          <div class="row text-center">
                              @foreach ($chitiets as $chitiet )
                                   <div class="col-3">
                                        <img src="{{ asset('admin/images/products/'.$chitiet->hinh_anh) }}" class="img-fluid img-thumbnail" alt="Ảnh phụ 1" onclick="changeMainImage(this)">
                                   </div>
                              @endforeach
                          </div>
                       </div>
                  </div>
             </div>
             <div class="col-lg-8">
                  <div class="card">
                       <div class="card-body">
                            <h4 class="badge bg-success text-light fs-14 py-1 px-2">Hàng mới</h4>
                            <p class="mb-1">
                                 <a href="#!" class="fs-24 text-dark fw-medium">{{$product->ten_san_pham_vi}}</a>
                            </p>
                            <div class="d-flex gap-2 align-items-center">
                                 <ul class="d-flex text-warning m-0 fs-20  list-unstyled">
                                      <li>
                                           <i class="bx bxs-star"></i>
                                      </li>
                                      <li>
                                           <i class="bx bxs-star"></i>
                                      </li>
                                      <li>
                                           <i class="bx bxs-star"></i>
                                      </li>
                                      <li>
                                           <i class="bx bxs-star"></i>
                                      </li>
                                      <li>
                                           <i class="bx bxs-star-half"></i>
                                      </li>
                                 </ul>
                                 <p class="mb-0 fw-medium fs-18 text-dark">4.5 <span class="text-muted fs-13">(55 Review)</span></p>
                            </div>
                            <h2 class="fw-medium my-3">{{$product->gia_goc_vn}}  <!--<span class="fs-16 text-decoration-line-through">$100.00</span><small class="text-danger ms-2">(30%Off)</small>--> </h2>

                            <div class="quantity mt-4">
                                 <h4 class="text-dark fw-medium mt-3">Số lượng</h4>
                                 <div class="input-step border bg-body-secondary p-1 mt-1 rounded d-inline-flex overflow-visible">
                                      <p>{{$product->so_luong}}</p>
                                 </div>
                            </div>
                            <h4 class="text-dark fw-medium">Description Short:</h4> {{ $product->mo_ta_ngan_vi }}
                                   {!! html_entity_decode($product->mo_ta_ngan_vn) !!}
                            <h4 class="text-dark fw-medium mt-3">Description</h4>
                            <div class="d-flex align-items-center mt-2">
                                 <i class="bx bxs-bookmarks text-success me-3 fs-20 mt-1"></i>
                                 {!! html_entity_decode($product->mo_ta_vi) !!}
                            </div>
                            
                       </div>
                  </div>
             </div>
        </div>
     </div>
</div>
    <!-- End Container Fluid -->
    <script>
     function changeMainImage(element) {
       const mainImage = document.getElementById('mainImage');
       mainImage.src = element.src;
     }
   </script>
@endsection
