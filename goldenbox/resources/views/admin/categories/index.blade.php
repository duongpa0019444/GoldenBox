@extends('admin.admin')


@section('title', 'Trang Danh sách')
@section('description', '')
@section('content')
          <div class="page-content">         
               <div class="container-xxl">
                    <div class="row">
                        <h4 class="card-title flex-grow-1 mb-2">Top Categories List</h4>
                        @foreach ($topNDanhMucs as $topNDanhMuc)
                         <div class="col-md-6 col-xl-3">
                              <div class="card">
                                   <div class="card-body text-center">
                                        <div class="rounded bg-secondary-subtle d-flex align-items-center justify-content-center mx-auto">
                                             <img src="assets/images/product/p-1.png" alt="" class="avatar-xl">
                                        </div>
                                        <h4 class="mt-3 mb-0">{{$topNDanhMuc->ten_danh_muc_vi}}</h4>
                                   </div>
                              </div>
                         </div>
                        @endforeach
                    </div>

                    <div class="row">
                         <div class="col-xl-12">
                              <div class="card">
                                   <div class="card-header d-flex justify-content-between align-items-center gap-1">
                                        <h4 class="card-title flex-grow-1">All Categories List</h4>

                                        <a href="{{ route('admin.categories.add') }}" class="btn btn-sm btn-primary">
                                             Add Product
                                        </a>

                                        <div class="dropdown">
                                             <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                  This Month
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Download</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Export</a>
                                                  <!-- item-->
                                                  <a href="#!" class="dropdown-item">Import</a>
                                             </div>
                                        </div>
                                   </div>
                                   <div>
                                        <div class="table-responsive">
                                             <table class="table align-middle mb-0 table-hover table-centered">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th style="width: 20px;">
                                                                 <div class="form-check">
                                                                      <input type="checkbox" class="form-check-input" id="customCheck1">
                                                                      <label class="form-check-label" for="customCheck1"></label>
                                                                 </div>
                                                            </th>
                                                            <th>Categories</th>
                                                            <th>ID</th>
                                                            <th>Số lượng sản phẩm</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($categories as $category)
                                                    <tr>
                                                        <td>
                                                             <div class="form-check">
                                                                  <input type="checkbox" class="form-check-input" id="customCheck2">
                                                                  <label class="form-check-label" for="customCheck2"></label>
                                                             </div>
                                                        </td>
                                                        <td>
                                                             <div class="d-flex align-items-center gap-2">
                                                                  <p class="text-dark fw-medium fs-15 mb-0">{{$category->ten_danh_muc_vi}}</p>
                                                             </div>

                                                        </td>       
                                                        <td>{{$category->id}}</td>
                                                        <td>{{$category->so_luong_san_pham}}</td>
                                                        <td>
                                                             <div class="d-flex gap-2">
                                                                  <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                  <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
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
              
@endsection