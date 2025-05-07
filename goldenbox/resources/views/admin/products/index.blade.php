@extends('admin.admin')


@section('title', 'Trang Danh sách')
@section('description', '')
@section('content')
    <div class="page-content">
        <!-- Start Container Fluid -->
        <div class="container-fluid">
             <div class="row">
                  <div class="col-xl-12">
                       <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                 <h4 class="card-title flex-grow-1">All Product List</h4>
                                 <form action="{{route('admin.product.search')}}" method="get" class="app-search d-none d-md-block ms-2">
                                   <div class="position-relative">
                                       <input type="search" class="form-control" name="search" placeholder="Search..." autocomplete="off" value="">
                                       <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                                        <button type="submit" hidden></button>
                                        </div>
                                   </form>
                                   {{-- <form action="" method="get">
                                        <input type="text" class="form-control" name="search" placeholder="Search...">
                                   <button type="submit" class="btn btn-sm btn-primary">Search</button>       
                                   </form>           --}}
                                 <a href="{{ route('admin.products.add') }}" class="btn btn-sm btn-primary">
                                      Add Product
                                 </a>
                            </div>
                            <div>
                                 <div class="table-responsive">
                                      <table class="table align-middle mb-0 table-hover table-centered">
                                           <thead class="bg-light-subtle">
                                                <tr>
                                                     <th style="width: 20px;">
                                                          <div class="form-check ms-1">
                                                               <input type="checkbox" class="form-check-input" id="customCheck1">
                                                               <label class="form-check-label" for="customCheck1"></label>
                                                          </div>
                                                     </th>
                                                     <th>Product Name & Size</th>
                                                     <th>Price</th>
                                                     <th>Stock</th>
                                                     <th>Category</th>
                                                     <th>Rating</th>
                                                     <th>Action</th>
                                                </tr>
                                           </thead>
                                           <tbody>
                                            @foreach ($products as $product )
                                                <tr>
                                                     <td>
                                                        <div class="form-check ms-1">
                                                             <input type="checkbox" class="form-check-input" id="customCheck2">
                                                             <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                        </div>
                                                   </td>
                                                   <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                             <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                                  <img src="{{ asset('admin/images/products/'.$product->anh_chinh) }}" alt="" class="avatar-md">
                                                             </div>
                                                             <div>
                                                                  <a href="{{ route('admin.product.detail', $product->id) }}" class="text-dark fw-medium fs-15">{{$product->ten_san_pham_vi}}</a>
                                                                  <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S , M , L , Xl </p>
                                                             </div>
                                                        </div>
  
                                                   </td>
                                                   <td>{{$product->gia_goc_vi}}</td>
                                                   <td>
                                                        <p class="mb-1 text-muted"><span class="text-dark fw-medium">486 Item</span> Left</p>
                                                        <p class="mb-0 text-muted">155 Sold</p>
                                                   </td>
                                                   <td>{{$product->ten_danh_muc_vi}}</td>
                                                   <td> <span class="badge p-1 bg-light text-dark fs-12 me-1">55 Review</td>
                                                   <td>
                                                        <div class="d-flex gap-2">
                                                             <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                             <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                             <a href="{{ route('admin.product.delete', $product->id)}}" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                        </div>
                                                   </td>
                                                </tr>
                                            @endforeach
                                           </tbody>
                                      </table>
                                 </div>
                                 <!-- end table-responsive -->
                            </div>
                            <div class="card-footer border-top">
                                 <nav aria-label="Page navigation example">
                                      <ul class="pagination justify-content-end mb-0">
                                           <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                           <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                           <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                           <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                           <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                                      </ul>
                                 </nav>
                            </div>
                       </div>
                  </div>
    
             </div>
    
        </div>
        <!-- End Container Fluid -->
@endsection

