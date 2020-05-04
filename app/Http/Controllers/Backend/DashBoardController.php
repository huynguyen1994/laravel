<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /**
     * Display  of the dashboard.
     *
     *
     */
    public function index()
    {
        return view("backend.dashboard.index");
    }
}
