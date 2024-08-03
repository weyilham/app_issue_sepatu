<?php

namespace App\Http\Controllers;

use App\Models\issue;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IssueAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = issue::orderBy('id', 'desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('dashboard.issue.tombol', compact('data'));
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(issue $issue)
    {
        //
    }
}
