<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboar');
    }

    public function history() {
        return view('admin.activity');
    }
}
