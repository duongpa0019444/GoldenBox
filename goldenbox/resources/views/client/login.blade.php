@extends('client.client')


@section('title', 'Trang đăng nhập')
@section('description', '')
@section('content')

    <div class="container d-flex justify-content-center align-item-center">

        <form action="{{ route('admin.login') }}" method="post" enctype="multipart/form-data" class="col-lg-6 col-md-12">
            @csrf
            <h2 class="text-center">Đăng Nhập</h2>
            <div class="mb-3">
                <label class="form-label">Email đăng nhập</label>
                <input type="email" class="form-control" name="email">
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="text" class="form-control" name="password">
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error'); }}
                </div>
            @endif
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>

    </div>
@endsection
