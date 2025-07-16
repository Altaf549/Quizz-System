<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class DashboardController extends Controller
{
    public function index()
    {
        $staff = auth()->guard('staff')->user();
        return view('dashboard.index', compact('staff'));
    }
}
