<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\danh_mucs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('danh_mucs as dm')
        ->leftJoin('san_phams as sp', 'dm.id', '=', 'sp.id_danh_muc')
        ->select('dm.id', 'dm.ten_danh_muc_vi', DB::raw('COUNT(sp.id) as so_luong_san_pham'))
        ->groupBy('dm.id', 'dm.ten_danh_muc_vi')
        ->orderByDesc('so_luong_san_pham')
        ->get();

        $topNDanhMucs = DB::table('danh_mucs as dm')
        ->leftJoin('san_phams as sp', 'dm.id', '=', 'sp.id_danh_muc')
        ->select('dm.id', 'dm.ten_danh_muc_vi', DB::raw('COUNT(sp.id) as so_luong_san_pham'))
        ->groupBy('dm.id', 'dm.ten_danh_muc_vi')
        ->orderByDesc('so_luong_san_pham')
        ->limit(5) // Lấy top 5
        ->get();
        return view('admin.categories.index', compact('categories', 'topNDanhMucs'));
    }

    public function add(Request $request)
    {
        return view('admin.categories.add');
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'ten_danh_muc_vi' => 'required|string|max:255',
            'ten_danh_muc_en' => 'required|string|max:255',
        ]);

        $category = new danh_mucs();

        $category->slug = $request->slug ?? Str::slug($request->ten_danh_muc_vi, '-');

        $category->ten_danh_muc_vi = $request->ten_danh_muc_vi;
        $category->ten_danh_muc_en = $request->ten_danh_muc_en;

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    

    public function edit($id)
    {
        $category = danh_mucs::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ten_danh_muc_vi' => 'required|string|max:255',
            'ten_danh_muc_en' => 'required|string|max:255',
        ]);

        $category = danh_mucs::findOrFail($id);

        $category->slug = $request->slug ?? Str::slug($request->ten_danh_muc_vi, '-');

        $category->ten_danh_muc_vi = $request->ten_danh_muc_vi;
        $category->ten_danh_muc_en = $request->ten_danh_muc_en;

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }
    public function delete($id)
    {
        $category = danh_mucs::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}
