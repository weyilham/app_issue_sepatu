<?php

namespace App\Http\Controllers;

use App\Models\Sepatu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SepatuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.sepatu.index', [
            'sepatu' => Sepatu::orderBy('id', 'desc')->get(),
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validasi = Validator::make($request->all(), [
            'nama_merk' => 'required|unique:sepatus,nama_merk',
            'slug' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada'
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors()
            ], 422); // Status code 422 untuk Unprocessable Entity
        } else {
            $data = [
                'nama_merk' => $request->nama_merk,
                'slug' => $request->slug
            ];

            Sepatu::create($data);

            return response()->json([
                'data' => $data,
                'jumlah' => Sepatu::count(),
                'success' => 'Data Berhasil di Tambahkan'
            ], 201); // Status code 201 untuk Created
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sepatu  $sepatu
     * @return \Illuminate\Http\Response
     */
    public function show(Sepatu $sepatu)
    {
        //
        // dd($sepatu);
        return response()->json(['data' => $sepatu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sepatu  $sepatu
     * @return \Illuminate\Http\Response
     */
    public function edit(Sepatu $sepatu)
    {
        //
        // dd($sepatu);
        return response()->json(['data' => $sepatu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sepatu  $sepatu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sepatu $sepatu)
    {
        //
        $validasi = Validator::make($request->all(), [
            'nama_merk' => 'required',
            'slug' => 'required'
        ], [
            'required' => ':attribute tidak boleh kosong',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors()
            ]);
        } else {
            $data = [
                'nama_merk' => $request->nama_merk,
                'slug' => $request->slug
            ];
            // dd($data);
            Sepatu::where('id', $sepatu->id)->update($data);
            return response()->json(['data' => $data, 'success' => 'Data Berhasil di Update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sepatu  $sepatu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sepatu $sepatu)
    {
        //
        $sepatu->delete();
        return response()->json(['success' => 'Data Berhasil di Hapus']);
    }
}
