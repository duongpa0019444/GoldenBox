<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{

    public function dashBoard(HttpRequest $request)
    {
        $countData = DB::select("
            SELECT
                (SELECT COUNT(*) FROM danh_mucs) AS tong_danh_muc,
                (SELECT COUNT(*) FROM san_phams) AS tong_san_pham,
                (SELECT COUNT(*) FROM ma_khuyen_mais) AS tong_ma_khuyen_mai,
                (SELECT COUNT(*) FROM bai_viets) AS tong_bai_viet,
                (SELECT COUNT(*) FROM don_hangs WHERE trang_thai_giao_hang = 'đã giao' AND trang_thai_thanh_toan = 'đã thanh toán') AS tong_don_da_ban,
                (SELECT COUNT(*) FROM don_hangs WHERE trang_thai_giao_hang = 'chưa giao') AS tong_don_chua_giao
            FROM DUAL;
        ")[0];

        $ordersNews = orders::where('trang_thai_call', 'chưa gọi')
            ->withCount('chiTietDonHangs')
            ->paginate(5);

        // Kiểm tra nếu là AJAX request
        if ($request->ajax()) {
            return response()->json([
                'data' => $ordersNews->items(),
                'pagination' => $ordersNews->links('pagination::bootstrap-5')->toHtml()
            ]);
        }

        $products = DB::table('san_phams')->get();
        return view('admin.dashdoard', compact('countData', 'ordersNews', 'products'));
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
                AND dh.trang_thai_thanh_toan = 'đã thanh toán'
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
                AND dh.trang_thai_thanh_toan = 'đã thanh toán'
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
                AND dh.trang_thai_thanh_toan = 'đã thanh toán'
            GROUP BY ml.month_num, ml.month_start, ml.month_end
            ORDER BY ml.month_num;
        ");


        return response()->json([
            'turnoverDate' => $turnoverDate,
            'turnoverWeek' => $turnoverWeek,
            'turnoverMonth' => $turnoverMonth

        ]);
    }



    public function turnoverProducts($id)
    {

        $turnoverDate = DB::select(
            "
            WITH DateRange AS (
                SELECT
                    ADDDATE(DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY), num) AS full_date
                FROM (
                    SELECT 0 AS num UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
                    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                ) AS numbers
            ),
            FilteredProducts AS (
                SELECT
                    sp.id AS product_id,
                    COALESCE(sp.ten_san_pham_vi, sp.ten_san_pham_en) AS product_name
                FROM san_phams sp
                WHERE sp.id = ?
            )

            SELECT
                pd.product_id AS 'id',
                pd.product_name AS 'ten_san_pham',
                CASE pd.day_of_week
                    WHEN 1 THEN 'Chủ nhật'
                    WHEN 2 THEN 'Thứ hai'
                    WHEN 3 THEN 'Thứ ba'
                    WHEN 4 THEN 'Thứ tư'
                    WHEN 5 THEN 'Thứ năm'
                    WHEN 6 THEN 'Thứ sáu'
                    WHEN 7 THEN 'Thứ bảy'
                END AS 'ten_thu',
                pd.full_date AS 'ngay',
                COALESCE(SUM(ctdh.so_luong), 0) AS 'so_don',
                COALESCE(SUM(ctdh.so_luong * ctdh.don_gia), 0) AS 'doanh_thu'
            FROM (
                SELECT
                    fp.product_id,
                    fp.product_name,
                    d.full_date,
                    DAYOFWEEK(d.full_date) AS day_of_week
                FROM FilteredProducts fp
                CROSS JOIN DateRange d
            ) AS pd
            LEFT JOIN don_hangs dh ON DATE(dh.created_at) = pd.full_date AND dh.trang_thai_thanh_toan = 'đã thanh toán'
            LEFT JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.id_don_hang AND ctdh.id_san_pham = pd.product_id
            GROUP BY pd.product_id, pd.full_date
            ORDER BY pd.full_date, pd.product_id;

        ",
            [$id]
        );

        $turnoverWeek = DB::select("
                WITH DateRange AS (
                    SELECT
                        DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL (a.a + (b.a * 10)) DAY) AS full_date
                    FROM
                        (SELECT 0 a UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
                        UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) a,
                        (SELECT 0 a UNION SELECT 1 UNION SELECT 2 UNION SELECT 3) b
                    WHERE DATE_ADD(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL (a.a + (b.a * 10)) DAY) <= LAST_DAY(CURDATE())
                ),
                WeeksInMonth AS (
                    SELECT
                        full_date,
                        CASE
                            WHEN DAY(full_date) BETWEEN 1 AND 7 THEN 'Tuần 1'
                            WHEN DAY(full_date) BETWEEN 8 AND 14 THEN 'Tuần 2'
                            WHEN DAY(full_date) BETWEEN 15 AND 21 THEN 'Tuần 3'
                            ELSE 'Tuần 4'
                        END AS week_label
                    FROM DateRange
                ),
                FilteredProducts AS (
                    SELECT
                        sp.id AS product_id,
                        COALESCE(sp.ten_san_pham_vi, sp.ten_san_pham_en) AS product_name
                    FROM san_phams sp
                    WHERE sp.id = ?
                ),
                AllWeeks AS (
                    SELECT 'Tuần 1' AS week_label UNION
                    SELECT 'Tuần 2' UNION
                    SELECT 'Tuần 3' UNION
                    SELECT 'Tuần 4'
                ),
                ProductWeeks AS (
                    SELECT
                        aw.week_label,
                        fp.product_id,
                        fp.product_name
                    FROM AllWeeks aw
                    CROSS JOIN FilteredProducts fp
                )

                SELECT
                    pw.product_id AS id,
                    pw.product_name AS ten_san_pham,
                    pw.week_label AS tuan,
                    COALESCE(SUM(ctdh.so_luong), 0) AS so_don,
                    COALESCE(SUM(ctdh.so_luong * ctdh.don_gia), 0) AS doanh_thu
                FROM ProductWeeks pw
                LEFT JOIN WeeksInMonth wm ON wm.week_label = pw.week_label
                LEFT JOIN don_hangs dh ON DATE(dh.created_at) = wm.full_date AND dh.trang_thai_thanh_toan = 'đã thanh toán'
                LEFT JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.id_don_hang AND ctdh.id_san_pham = pw.product_id
                GROUP BY pw.product_id, pw.week_label
                ORDER BY pw.week_label;

    ", [$id]);


        $turnoverMonth = DB::select("
                WITH Months AS (
                    SELECT 1 AS month_number UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                    UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
                ),
                FilteredProducts AS (
                    SELECT
                        sp.id AS product_id,
                        COALESCE(sp.ten_san_pham_vi, sp.ten_san_pham_en) AS product_name
                    FROM san_phams sp
                    WHERE sp.id = ?
                ),
                ProductMonths AS (
                    SELECT
                        m.month_number,
                        fp.product_id,
                        fp.product_name
                    FROM Months m
                    CROSS JOIN FilteredProducts fp
                ),
                FilteredOrders AS (
                    SELECT
                        dh.id AS don_hang_id,
                        dh.created_at,
                        ctdh.id_san_pham,
                        ctdh.so_luong,
                        ctdh.don_gia
                    FROM don_hangs dh
                    JOIN chi_tiet_don_hangs ctdh ON dh.id = ctdh.id_don_hang
                    WHERE dh.trang_thai_thanh_toan = 'đã thanh toán'
                    AND YEAR(dh.created_at) = YEAR(CURDATE())
                )

                SELECT
                    pm.product_id AS id,
                    pm.product_name AS ten_san_pham,
                    pm.month_number AS thang,
                    COALESCE(SUM(fo.so_luong), 0) AS so_don,
                    COALESCE(SUM(fo.so_luong * fo.don_gia), 0) AS doanh_thu
                FROM ProductMonths pm
                LEFT JOIN FilteredOrders fo
                    ON pm.product_id = fo.id_san_pham
                    AND MONTH(fo.created_at) = pm.month_number
                GROUP BY pm.product_id, pm.month_number
                ORDER BY pm.month_number;

    ", [$id]);

        return response()->json([
            'turnoverDate' => $turnoverDate,
            'turnoverWeek' => $turnoverWeek,
            'turnoverMonth' => $turnoverMonth

        ]);
    }


    public function search(Request $request)
    {
        try {
            $search = $request->query('search');

            $query = DB::table('don_hangs as dh')
                ->select('dh.*', 'u.name as user_name')
                ->leftJoin('users as u', 'dh.id_user', '=', 'u.id')
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('dh.id', 'like', "%{$search}%")
                            ->orWhere('dh.ho_ten', 'like', "%{$search}%")
                            ->orWhere('dh.trang_thai_thanh_toan', 'like', "%{$search}%")
                            ->orWhere('dh.trang_thai_giao_hang', 'like', "%{$search}%")
                            ->orWhere('dh.ghi_chu', 'like', "%{$search}%")
                            ->orWhere('u.name', 'like', "%{$search}%");
                    });
                })
                ->where('dh.trang_thai_call', 'chưa gọi')
                ->orderBy('dh.id', 'desc');

            $orders = $query->paginate(10);
            $orders->getCollection()->transform(function ($order) {
                $order->tong_tien_formatted = number_format($order->tong_tien, 0, ',', '.') . ' đ';
                $order->chi_tiet_don_hangs_count = DB::table('chi_tiet_don_hangs')
                    ->where('id_don_hang', $order->id)
                    ->count();
                return $order;
            });
            return response()->json([
                'data' => $orders->items(),
                'pagination' => $orders->links('pagination::bootstrap-5')->toHtml()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }
}
