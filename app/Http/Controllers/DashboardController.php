<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function dashboard_admin()
    {
        return view('/admin/dashboard')->with('activeTab', 'data-dashboard');
    }

    public function dashboard_member()
    {
        $member = Member::find(Auth::guard('member')->user()->id);
        return view('/member/dashboard', ['member' => $member])->with('activeTab', 'data-dashboard');
    }
}
