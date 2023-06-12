<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class MemberController extends Controller
{
    public function __construct()
    {
        $pageTitle = "Member Area";
        View::share(compact('pageTitle'));
    }

    public function dashboard()
    {
        $data = [
            'menu_active'   => 'dashboard',
            'parent_active' => '',
        ];

        return view('member.welcome', $data);
    }
}
