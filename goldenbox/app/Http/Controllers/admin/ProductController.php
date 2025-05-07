<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\chi_tiet_anh;
use App\Models\Product;
use App\Models\san_phams;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('san_phams')
        ->join('danh_mucs', 'san_phams.id_danh_muc', '=', 'danh_mucs.id')
        ->select(
            'san_phams.*', 
            'danh_mucs.ten_danh_muc_vi as ten_danh_muc_vi'
        )
        ->get();

        return view('admin.products.index', compact('products'));
    }

    public function detail($id)
    {
        $product = san_phams::findOrFail($id);

        $chitiets = DB::table('chi_tiet_anhs as anh')
            ->join('san_phams as sp', 'anh.id_san_pham', '=', 'sp.id')
            ->where('sp.id', $id)
            ->select('sp.ten_san_pham_vi', 'anh.hinh_anh')
            ->get();

        return view('admin.products.detail', compact('product', 'chitiets'));
    }   

    public function add()
    {
        $catalogies = DB::table('danh_mucs')->get();
        return view('admin.products.add', compact('catalogies'));
    }
    
    public function create(Request $request)
        {
            // Validate input
            $data = $request->validate([
                'ten_san_pham_vi' => 'required',
                'ten_san_pham_en' => 'required',
                'id_danh_muc' => 'required',
                'mo_ta_vi' => 'required',
                'gia_goc_vi' => 'required|numeric',
                'so_luong' => 'required|integer',
            ], [
                'ten_san_pham_vi.required' => 'Tên sản phẩm (VI) không được để trống.',
                'ten_san_pham_en.required' => 'Tên sản phẩm (EN) không được để trống.',
                'id_danh_muc.required' => 'Danh mục là bắt buộc.',
                'mo_ta_vi.required' => 'Mô tả (VI) không được để trống.',
                'gia_goc_vi.required' => 'Giá gốc là bắt buộc.',
                'gia_goc_vi.numeric' => 'Giá gốc phải là số.',
                'so_luong.required' => 'Số lượng là bắt buộc.',
                'so_luong.integer' => 'Số lượng phải là số nguyên.',
            ]);


            // 1. Xử lý ảnh chính
            $imageName = $request->input('anh_chinh'); // VD: "temp/abc.jpg"

            $sourceFile = storage_path('app/private/' . $imageName); // storage/app/private/temp/abc.jpg
            $destinationDir = public_path('admin/images/products');
            $destinationFile = $destinationDir . '/' . basename($imageName); // public/admin/images/products/abc.jpg

            if (file_exists($sourceFile)) {
                if (!file_exists($destinationDir)) {
                    File::makeDirectory($destinationDir, 0755, true); // Tạo thư mục nếu chưa có
                }
                File::copy($sourceFile, $destinationFile); // 📌 Dùng copy thay vì move
            }

            // 2. Xử lý ảnh phụ
            $uploadedImageNames = $request->input('hinh_anh', []); // input hidden name="hinh_anh[]"
            $finalImagePaths = [];

            if ($uploadedImageNames) {
                foreach ($uploadedImageNames as $img) {

                    $src = storage_path('app/private/' . $img);
                    $dest = public_path('admin/images/products/' . basename($img));
                    if (file_exists($src)) {
                        File::copy($src, $dest);
                    }

                    $finalImagePaths[] = 'admin/images/products/' . $img;

                    if (count($finalImagePaths) >= 4) {
                        break;
                    }
                }
            } else {
                $finalImagePaths[] = 'admin/images/products/avt.png';
            }


            // 3. Lưu sản phẩm vào DB
            $productId = DB::table('san_phams')->insertGetId([
                'ten_san_pham_vi' => $request->ten_san_pham_vi,
                'ten_san_pham_en' => $request->ten_san_pham_en,
                'id_danh_muc' => $request->id_danh_muc,
                'mo_ta_ngan_vi' => $request->mo_ta_ngan_vi,
                'mo_ta_ngan_en' => $request->mo_ta_ngan_en,
                'mo_ta_vi' => $request->mo_ta_vi,
                'mo_ta_en' => $request->mo_ta_en,
                'gia_goc_vi' => $request->gia_goc_vi,
                'gia_goc_en' => $request->gia_goc_en,
                'so_luong' => $request->so_luong,
                'slug' => $request->slug ?? Str::slug($request->ten_san_pham_vi, '-'),
                'anh_chinh' => basename($imageName),
            ]);

            // 4. Lưu ảnh phụ vào bảng chi_tiet_anh
            foreach ($finalImagePaths as $imagePath) {
                $anhSub = new chi_tiet_anh();
                $anhSub->id_san_pham = $productId;
                $anhSub->hinh_anh = basename($imagePath); // chỉ lưu tên ảnh
                $anhSub->save();
            }

            return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
        }

    public function edit($id)
    {
        $product = DB::table('san_phams')
        ->join('danh_mucs', 'san_phams.id_danh_muc', '=', 'danh_mucs.id')
        ->select(
            'san_phams.*', 
            'danh_mucs.ten_danh_muc_vi as ten_danh_muc_vi'
        )
        ->where('san_phams.id', $id)
        ->first();

        $chitiets = DB::table('chi_tiet_anhs as anh')
        ->join('san_phams as sp', 'anh.id_san_pham', '=', 'sp.id')
        ->where('sp.id', $id)
        ->select('sp.ten_san_pham_vi', 'anh.hinh_anh')
        ->get();

       
        $catalogies = DB::table('danh_mucs')->get();
        return view('admin.products.edit', compact('product', 'catalogies', 'chitiets'));
    }

    public function update(Request $request, $id)
    {
        // Lấy sản phẩm hiện tại
        $product = san_phams::findOrFail($id);

        // Validate dữ liệu
        $data = $request->validate([
            'ten_san_pham_vi' => 'required',
            'ten_san_pham_en' => 'required',
            'id_danh_muc' => 'required',
            'mo_ta_vi' => 'required',
            'gia_goc_vi' => 'required|numeric',
            'so_luong' => 'required|integer',
        ], [
            'ten_san_pham_vi.required' => 'Tên sản phẩm (VI) không được để trống.',
            'ten_san_pham_en.required' => 'Tên sản phẩm (EN) không được để trống.',
            'id_danh_muc.required' => 'Danh mục là bắt buộc.',
            'mo_ta_vi.required' => 'Mô tả (VI) không được để trống.',
            'gia_goc_vi.required' => 'Giá gốc là bắt buộc.',
            'gia_goc_vi.numeric' => 'Giá gốc phải là số.',
            'so_luong.required' => 'Số lượng là bắt buộc.',
            'so_luong.integer' => 'Số lượng phải là số nguyên.',
        ]);

        // ===== Xử lý ảnh chính =====
        $imageName = $product->anh_chinh ?? 'avt.png'; // giữ ảnh cũ mặc định
        if ($request->hasFile('anh_chinh')) {
            $file = $request->file('anh_chinh');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('admin/images/products'), $imageName);
        }

                // ===== Xử lý ảnh phụ =====
        $keepImages = []; // Danh sách ảnh được giữ lại

        // Lấy tất cả ảnh phụ cũ trong DB
        $oldImages = chi_tiet_anh::where('id_san_pham', $id)->get();

        // Duyệt từng ảnh cũ theo index
        foreach ($oldImages as $index => $old) {
            $inputName = "hinh_anh." . $index;

    if ($request->hasFile($inputName)) {
        // Nếu người dùng upload ảnh mới tại vị trí này → xóa ảnh cũ
        if ($old->hinh_anh != 'avt.png' && file_exists(public_path('admin/images/products/' . $old->hinh_anh))) {
            unlink(public_path('admin/images/products/' . $old->hinh_anh));
        }
        $old->delete();

        // Upload ảnh mới
        $newFile = $request->file($inputName);
        $newFilename = time() . '_' . uniqid() . '.' . $newFile->getClientOriginalExtension();
        $newFile->move(public_path('admin/images/products'), $newFilename);

        $newImg = new chi_tiet_anh();
        $newImg->id_san_pham = $id;
        $newImg->hinh_anh = $newFilename;
        $newImg->save();
    } else {
        // Nếu không upload ảnh mới → giữ ảnh cũ
        $keepImages[] = $old->hinh_anh;
    }
    }

    // Upload thêm ảnh mới (ngoài các ảnh cũ đã hiển thị sẵn)
    if ($request->hasFile('hinh_anh_new')) {
        foreach ($request->file('hinh_anh_new') as $imageSub) {
            $filename = time() . '_' . uniqid() . '.' . $imageSub->getClientOriginalExtension();
            $imageSub->move(public_path('admin/images/products'), $filename);

            $anhSub = new chi_tiet_anh();
            $anhSub->id_san_pham = $id;
            $anhSub->hinh_anh = $filename;
            $anhSub->save();
        }
    }

        // ===== Cập nhật sản phẩm =====
        DB::table('san_phams')
            ->where('id', $id)
            ->update([
                'ten_san_pham_vi' => $request->ten_san_pham_vi,
                'ten_san_pham_en' => $request->ten_san_pham_en,
                'id_danh_muc' => $request->id_danh_muc,
                'mo_ta_ngan_vi' => $request->mo_ta_ngan_vi,
                'mo_ta_ngan_en' => $request->mo_ta_ngan_en,
                'mo_ta_vi' => $request->mo_ta_vi,
                'mo_ta_en' => $request->mo_ta_en,
                'gia_goc_vi' => $request->gia_goc_vi,
                'gia_goc_en' => $request->gia_goc_en,
                'so_luong' => $request->so_luong,
                'slug' => $request->slug ?? Str::slug($request->ten_san_pham_vi, '-'),
                'anh_chinh' => $imageName,
            ]);

        return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    
    

    public function delete($id)
    {
        $product = san_phams::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        // $request->validate([
        //     'search' => 'required',
        // ]);
    
        $search = $request->input('search');
    
        // Nếu không có từ khóa tìm kiếm thì trả về danh sách sản phẩm đầy đủ
        if (empty($search)) {
            return redirect()->route('admin.product.index');
        }
    
        $products = DB::table('san_phams')
            ->join('danh_mucs', 'san_phams.id_danh_muc', '=', 'danh_mucs.id')
            ->select(
                'san_phams.*',
                'danh_mucs.ten_danh_muc_vi as ten_danh_muc_vi'
            )
            ->where('san_phams.ten_san_pham_vi', 'like', '%' . $search . '%')
            ->orWhere('danh_mucs.ten_danh_muc_vi', 'like', '%' . $search . '%')
            ->get();
    
        return view('admin.products.index', compact('products'));
    }
}
