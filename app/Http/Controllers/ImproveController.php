<?php

namespace App\Http\Controllers;

use App\Models\Improve;
use App\Http\Requests\StoreImproveRequest;
use App\Http\Requests\UpdateImproveRequest;

class ImproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreImproveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImproveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Improve  $improve
     * @return \Illuminate\Http\Response
     */
    public function show(Improve $improve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Improve  $improve
     * @return \Illuminate\Http\Response
     */
    public function edit(Improve $improve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImproveRequest  $request
     * @param  \App\Models\Improve  $improve
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImproveRequest $request, Improve $improve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Improve  $improve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Improve $improve)
    {
        //
    }
}
