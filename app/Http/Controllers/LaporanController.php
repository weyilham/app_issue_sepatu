<?php

namespace App\Http\Controllers;

use App\Exports\ExportImprove;
use App\Exports\ExportIssue;
use App\Models\Artikel;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.laporan.index');
    }

    public function improve()
    {
        return view('dashboard.laporan.improve');
    }

    public function getDataLaporan(Request $request)
    {
        // dd($request->WaktuAwal);
        $awal = Carbon::parse($request->WaktuAwal)->startOfDay();
        $akhir = Carbon::parse($request->WaktuAkhir)->endOfDay();

        $issue = Issue::where('created_at', '>=', $awal)
            ->where('created_at', '<=', $akhir)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(['data' => $issue, 'artikel' => Artikel::all()]);
    }

    public function getDataLaporanImprove(Request $request)
    {
        $awal = Carbon::parse($request->WaktuAwal)->startOfDay();
        $akhir = Carbon::parse($request->WaktuAkhir)->endOfDay();

        $issue = Issue::where('updated_at', '>=', $awal)
            ->where('updated_at', '<=', $akhir)
            ->where('status', 'Selesai')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $issue, 'artikel' => Artikel::all()]);
    }

    public function exportIssue(Request $request)
    {
        // dd($request->all());
        $awal = $request->awal;
        $akhir = $request->akhir;
        return Excel::download(new ExportIssue($awal, $akhir), 'data_issue.xlsx');
    }

    public function exportImprove(Request $request)
    {
        // dd($request->all());
        $awal = $request->awal;
        $akhir = $request->akhir;
        return Excel::download(new ExportImprove($awal, $akhir), 'data_improve.xlsx');
    }

    public function downloadPdf(Request $request){
        $tgl_awal = Carbon::parse($request->awal)->startOfDay();
        $tgl_akhir = Carbon::parse($request->akhir)->endOfDay();

        $results = DB::table('issues')
            ->join('artikels', 'artikels.id', '=', 'issues.artikel_id')
            ->join('sepatus', 'sepatus.id', '=', 'artikels.sepatu_id')
            ->select(
                'sepatus.nama_merk',
                'artikels.nama_artikel',
                'issues.tgl_issue',
                'issues.tgl_selesai',
                'issues.estimasi',
                'issues.catatan',
                'issues.gambar',
                'issues.deskripsi',
                'issues.status'
            )
            ->whereBetween('issues.created_at', [$tgl_awal, $tgl_akhir])
            ->where('issues.status', '<>' ,'Selesai')
            ->orderBy('issues.id',  'desc')
            ->get();

        return view('dashboard.laporan.issue-pdf', compact('results'));
       
    }

    public function downloadImpovePdf(Request $request){
       
        $tgl_awal = Carbon::parse($request->awal)->startOfDay();
        $tgl_akhir = Carbon::parse($request->akhir)->endOfDay();

        $results = DB::table('issues')
            ->join('artikels', 'artikels.id', '=', 'issues.artikel_id')
            ->join('sepatus', 'sepatus.id', '=', 'artikels.sepatu_id')
            ->select(
                'sepatus.nama_merk',
                'artikels.nama_artikel',
                'issues.tgl_issue',
                'issues.updated_at',
                'issues.tgl_selesai',
                'issues.estimasi',
                'issues.catatan',
                'issues.gambar',
                'issues.deskripsi',
                'issues.status'
            )
            ->whereBetween('issues.updated_at', [$tgl_awal, $tgl_akhir])
            ->where('issues.status', 'Selesai')
            ->orderBy('issues.id', 'desc')
            ->get();

            // dd($results);

        return view('dashboard.laporan.improve-pdf', compact('results'));
    }
}
