<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Sepatu;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.artikel.index', [
            'artikels' => Artikel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.artikel.create', [
            'sepatu' => Sepatu::all()
        ]);
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
        $validate = $request->validate([
            'sepatu_id' => 'required',
            'nama_artikel' => 'required|max:255',
            'keterangan' => 'nullable',
        ]);

        Artikel::create($validate);
        return redirect('/artikel')->with('success', 'Data Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        //
        return view('dashboard.artikel.edit', [
            'artikel' => $artikel,
            'sepatu' => Sepatu::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        //
        $id = $request->id;
        $validate = $request->validate([
            'sepatu_id' => 'required',
            'nama_artikel' => 'required|max:255',
            'keterangan' => 'nullable',
        ]);

        $artikel->update($validate);

        return redirect('/artikel')->with('success', 'Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        //
        $artikel->delete();
        return response()->json(['success' => 'Data Berhasil di Hapus']);
        // return redirect('/artikel')->with('success', 'Data Berhasil');
    }
}
