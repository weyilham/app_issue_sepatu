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
        $data = issue::orderBy('id', 'desc')->where('status', 'Issue')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.improve.tombol', compact('data'));
            })
            ->make(true);
    }

    public function getDataImprove()
    {
        $data = issue::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.improve.tombol', compact('data'));
            })
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        Issue::where('id', $id)->update([
            'status' => "Done",
        ]);
        return response()->json(['success' => 'Data Berhasil di Hapus']);
    }
}
