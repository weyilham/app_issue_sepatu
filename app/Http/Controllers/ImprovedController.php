<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Sepatu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ImprovedController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.improve.index');
    }

    public function getDataIssue()
    {
        $data = issue::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.improve.tombol', compact('data'));
            })
            ->make(true);
    }
}
