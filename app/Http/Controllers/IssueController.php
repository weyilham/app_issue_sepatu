<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Issue;
use App\Models\Sepatu;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.issue.index', [
            'sepatu' => Sepatu::all(),
            'artikel' => Artikel::all(),
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
        return view('dashboard.issue.create', [
            'sepatu' => Sepatu::all(),
            'issue' => Issue::all(),
            'artikel' => Artikel::all(),
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
        $data = $request->validate([
            'artikel_id' => 'required',
            'gambar' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'file' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus berupa gambar',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);


        if ($data['gambar']) {
            $data['gambar'] = $request->file('gambar')->store('gambar-issue');
        }

        $data['tgl_issue'] = date('Y-m-d');

        // dd($data);

        Issue::create($data);
        return redirect('/issue')->with(['success' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
        // dd($issue);
        return response()->json(['data' => $issue, 'artikel' => $issue->artikel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
        $id = $request->id;

        $data = $request->validate([
            'artikel_id' => 'required',
            'gambar' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required',
        ], [
            'required' => ':attribute tidak boleh kosong',
            'file' => ':attribute harus berupa gambar',
            'mimes' => ':attribute harus bereksensi jpg, jpeg, png',
            'max' => ':attribute tidak boleh lebih dari :max',
        ]);

        if ($request->hasFile('gambar')) {
            $oldImage = public_path('storage/' . $issue->gambar);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            $data['gambar'] = $request->file('gambar')->store('gambar-issue');
        }

        $data['tgl_issue'] = date('Y-m-d');

        Issue::where('id', $id)->update($data);
        return response()->json(['success' => 'Data Berhasil di Update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
        if ($issue->gambar) {
            unlink(public_path('storage/' . $issue->gambar));
        }
        $issue->delete();
        return response()->json(['success' => 'Data Berhasil di Hapus']);
    }
}
