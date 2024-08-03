<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //
    public function index()
    {
        $issue = Issue::all();
        return response()->json($issue);
    }
}
