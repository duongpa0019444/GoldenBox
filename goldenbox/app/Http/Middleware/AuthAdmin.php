<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin thì cho qua thoải mái
            return $next($request);
        }

        if ($user->role === 'nhanvien') {

            $allowedRoutes = [
                'profile.edit',
                'profile.update',
                'dashboard.view',
                // liệt kê các route cho phép nhân viên truy cập
            ];

            $currentRouteName = $request->route()->getName();

            if (in_array($currentRouteName, $allowedRoutes)) {
                return $next($request);
            } else {
                return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
            }
        }

        // Nếu không phải Admin cũng không phải Nhân viên thì xử lý chung
        session()->flush();
        return redirect()->route('home')->with('error', 'Quyền truy cập không hợp lệ.');
    }
}
