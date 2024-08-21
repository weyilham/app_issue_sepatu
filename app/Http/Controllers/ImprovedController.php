<?php

namespace App\Http\Controllers;

use App\Models\Improve;
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

    public function show($id)
    {
        $issue = Issue::find($id);
        return response()->json(['data' => $issue, 'artikel' => $issue->artikel]);
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

    public function update(Request $request, $id){
        // $improve = Improve::find($id);
        $improve = Issue::find($id);
        $improve->update($request->all());
        return response()->json(['success' => 'Status Issue Berhasil di Update']);
        // dd($id);
    }

    public function store(Request $request)
    {
        // $data = [
        //     'issue_id' => $request->issue_id,
        //     'tgl_improve' => date('Y-m-d'),
        //     'gambar' => 'default.png',
        // ];
        // dd('ok');

        // Improve::insert($data);

        Issue::where('id', $request->issue_id)->update([
            'status' => 'Done',
        ]);
        return response()->json(['success' => 'Data Berhasil di Improve']);
    }
}
