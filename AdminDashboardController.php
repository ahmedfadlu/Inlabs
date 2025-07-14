<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $labs = Laboratorium::all(); // hanya ambil data lab
        return view('admin.dashboard', compact('labs'));
    }
}
