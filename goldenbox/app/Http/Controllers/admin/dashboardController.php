<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    //
    public function dashBoard(HttpRequest $request)
    {
        $countData = DB::select("
            SELECT
                (SELECT COUNT(*) FROM danh_mucs) AS tong_danh_muc,
                (SELECT COUNT(*) FROM san_phams) AS tong_san_pham,
                (SELECT COUNT(*) FROM ma_khuyen_mais) AS tong_ma_khuyen_mai,
                (SELECT COUNT(*) FROM bai_viets) AS tong_bai_viet,
                (SELECT COUNT(*) FROM don_hangs WHERE trang_thai_giao_hang = 'da_giao' AND trang_thai_thanh_toan = 'da_thanh_toan') AS tong_don_da_ban,
                (SELECT COUNT(*) FROM don_hangs WHERE trang_thai_giao_hang = 'chua_giao') AS tong_don_chua_giao
            FROM DUAL;
        ")[0];

        $ordersNews = orders::where('trang_thai_giao_hang', 'chua_giao')
                    ->withCount('chiTietDonHangs')
                    ->paginate(5);

         // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            return response()->json([
                'data' => $ordersNews->items(),
                'pagination' => $ordersNews->links('pagination::bootstrap-5')->toHtml()
            ]);
        }
        return view('admin.dashdoard', compact('countData', 'ordersNews'));
    }



    public function turnover()
    {
        $turnoverDate = DB::select(
            "SELECT
                w.weekday,
                w.label,
                IFNULL(SUM(dh.tong_tien), 0) AS doanh_thu,
                COUNT(dh.id) AS so_don,
                DATE_FORMAT(dh.created_at, '%Y-%m-%d') AS ngay
            FROM (
                SELECT 2 AS weekday, 'Thứ 2' AS label UNION ALL
                SELECT 3, 'Thứ 3' UNION ALL
                SELECT 4, 'Thứ 4' UNION ALL
                SELECT 5, 'Thứ 5' UNION ALL
                SELECT 6, 'Thứ 6' UNION ALL
                SELECT 7, 'Thứ 7' UNION ALL
                SELECT 1, 'Chủ nhật'
            ) w
            LEFT JOIN don_hangs dh
                ON DAYOFWEEK(dh.created_at) = w.weekday
                AND dh.created_at >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY)
                AND dh.trang_thai_thanh_toan = 'da_thanh_toan'
            GROUP BY w.weekday, w.label, DATE_FORMAT(dh.created_at, '%Y-%m-%d')
            ORDER BY FIELD(w.weekday, 2, 3, 4, 5, 6, 7, 1);
        "
        );

        $turnoverWeek = DB::select("
            WITH date_weeks AS (
                SELECT
                    week_num,
                    DATE(current_month_start + INTERVAL (week_num - 1) * 7 DAY - INTERVAL WEEKDAY(current_month_start + INTERVAL (week_num - 1) * 7 DAY) DAY) AS week_start,
                    LEAST(
                        DATE(current_month_start + INTERVAL (week_num - 1) * 7 DAY + INTERVAL (6 - WEEKDAY(current_month_start + INTERVAL (week_num - 1) * 7 DAY)) DAY),
                        LAST_DAY(CURDATE())
                    ) AS week_end
                FROM (
                    SELECT 1 AS week_num UNION ALL
                    SELECT 2 UNION ALL
                    SELECT 3 UNION ALL
                    SELECT 4 UNION ALL
                    SELECT 5 UNION ALL
                    SELECT 6
                ) weeks,
                (SELECT DATE_FORMAT(CURDATE(), '%Y-%m-01') AS current_month_start) month_data
                WHERE DATE(current_month_start + INTERVAL (week_num - 1) * 7 DAY) <= LAST_DAY(CURDATE())
            )
            SELECT
                DATE_FORMAT(dw.week_start, '%d/%m/%Y') AS ngay_bat_dau_tuan,
                DATE_FORMAT(dw.week_end, '%d/%m/%Y') AS ngay_ket_thuc_tuan,
                IFNULL(SUM(dh.tong_tien), 0) AS doanh_thu,
                COUNT(DISTINCT dh.id) AS so_don
            FROM date_weeks dw
            LEFT JOIN don_hangs dh
                ON DATE(dh.created_at) BETWEEN dw.week_start AND dw.week_end
                AND dh.trang_thai_thanh_toan = 'da_thanh_toan'
            GROUP BY dw.week_start, dw.week_end
            ORDER BY dw.week_start;
        ");


        $turnoverMonth = DB::select("
                    WITH month_list AS (
                SELECT
                    month_num,
                    DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', LPAD(month_num, 2, '0'), '-01'), '%Y-%m-%d') AS month_start,
                    LAST_DAY(DATE_FORMAT(CONCAT(YEAR(CURDATE()), '-', LPAD(month_num, 2, '0'), '-01'), '%Y-%m-%d')) AS month_end
                FROM (
                    SELECT 1 AS month_num UNION ALL
                    SELECT 2 UNION ALL
                    SELECT 3 UNION ALL
                    SELECT 4 UNION ALL
                    SELECT 5 UNION ALL
                    SELECT 6 UNION ALL
                    SELECT 7 UNION ALL
                    SELECT 8 UNION ALL
                    SELECT 9 UNION ALL
                    SELECT 10 UNION ALL
                    SELECT 11 UNION ALL
                    SELECT 12
                ) months
            )
            SELECT
                DATE_FORMAT(ml.month_start, '%d/%m/%Y') AS ngay_bat_dau,
                DATE_FORMAT(ml.month_end, '%d/%m/%Y') AS ngay_ket_thuc,
                IFNULL(SUM(dh.tong_tien), 0) AS doanh_thu,
                COUNT(DISTINCT dh.id) AS so_don
            FROM month_list ml
            LEFT JOIN don_hangs dh
                ON DATE(dh.created_at) BETWEEN ml.month_start AND ml.month_end
                AND dh.trang_thai_thanh_toan = 'da_thanh_toan'
            GROUP BY ml.month_num, ml.month_start, ml.month_end
            ORDER BY ml.month_num;
        ");


        return response()->json([
            'turnoverDate' => $turnoverDate,
            'turnoverWeek' => $turnoverWeek,
            'turnoverMonth' => $turnoverMonth

        ]);
    }
}
