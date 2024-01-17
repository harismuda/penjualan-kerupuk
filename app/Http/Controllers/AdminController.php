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

    public function kerupuk() {
        return view('admin.kerupuk');
    }

    public function sell() {
        return view('admin.sell');
    }
}
