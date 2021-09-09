<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin/StatisticsManger');
    }

    public function NewsSectionManger(){
        return view('admin/NewsSectionManger');
    }

    public function NewsManger(){
        return view('admin/NewsManger');
    }
    public function AddNews(){
        return view('admin/AddNews');
    }
    public function EditNews(){
        return view('admin/EditNews');
    }

    public function StatisticsManger(){
        return view('admin/StatisticsManger');
    }

    public function UsersManger(){
        return view('admin/UsersManger');
    }

    public function AccountManger(){
        return view('admin/AccountManger');
    }

    public function test(){
        return view('admin/test');
    }
}
