<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
//main page
    public function index() {
        return view('pages.dashboard');
    }

}
