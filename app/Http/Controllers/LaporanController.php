<?php

namespace App\Http\Controllers;

use App\Exports\ExportImprove;
use App\Exports\ExportIssue;
use App\Models\Artikel;
use App\Models\Issue;
use App\Models\Sepatu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        $issue = Issue::where('created_at', '>=', $awal)
            ->where('created_at', '<=', $akhir)
            ->where('status', 'Done')
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
}
