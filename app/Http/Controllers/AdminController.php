<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GoldPrice;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    /**
     * لوحة التحكم الرئيسية
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $users = User::count();

        $prices = GoldPrice::count();

        $logs = ActivityLog::count();

        $averagePrice = round(
            GoldPrice::avg('price') ?? 0,
            2
        );

        $latestUsers = User::latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Gold Price Chart
        |--------------------------------------------------------------------------
        | جلب آخر 10 تحديثات ثم ترتيبها من الأقدم إلى الأحدث
        */

        $chartData = GoldPrice::query()
            ->latest('created_at')
            ->take(10)
            ->get(['id', 'karat', 'price', 'created_at'])
            ->reverse()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Dashboard View
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'users',
            'prices',
            'logs',
            'averagePrice',
            'latestUsers',
            'chartData'
        ));
    }


    /**
     * عرض جميع المستخدمين
     */
    public function users()
    {
        $users = User::latest()
            ->paginate(10);

        return view('admin.users', compact('users'));
    }


    /**
     * تغيير صلاحية المستخدم
     */
    public function changeRole(User $user)
    {
        if ($user->id === auth()->id()) {

            return back()->with(
                'error',
                'لا يمكنك تغيير صلاحية حسابك.'
            );
        }

        $user->role = $user->role === 'admin'
            ? 'user'
            : 'admin';

        $user->save();

        return back()->with(
            'success',
            'تم تحديث الصلاحية بنجاح.'
        );
    }


    /**
     * حذف مستخدم
     */
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {

            return back()->with(
                'error',
                'لا يمكنك حذف حسابك.'
            );
        }

        /*
         * منع حذف آخر مدير في النظام
         */

        if ($user->role === 'admin') {

            $admins = User::where('role', 'admin')
                ->count();

            if ($admins <= 1) {

                return back()->with(
                    'error',
                    'لا يمكن حذف آخر مدير في النظام.'
                );
            }
        }

        $user->delete();

        return back()->with(
            'success',
            'تم حذف المستخدم بنجاح.'
        );
    }


    /**
     * سجل العمليات
     */
    public function logs()
    {
        $logs = ActivityLog::with('user')
            ->latest()
            ->paginate(20);

        return view('admin.logs', compact('logs'));
    }
}