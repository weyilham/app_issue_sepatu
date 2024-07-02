<?php

namespace App\Http\Controllers;

use App\Exports\ExportImprove;
use App\Exports\ExportIssue;
use App\Models\Issue;
use App\Models\Sepatu;
use Illuminate\Http\Request;
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
        $issue = Issue::where('created_at', '>=', $request->WaktuAwal)->where('created_at', '<=', $request->WaktuAkhir)->where('status', 'Issue')->get();
        return response()->json(['data' => $issue, 'sepatu' => Sepatu::all()]);
    }

    public function getDataLaporanImprove(Request $request)
    {
        $issue = Issue::where('created_at', '>=', $request->WaktuAwal)->where('created_at', '<=', $request->WaktuAkhir)->where('status', 'Done')->get();
        return response()->json(['data' => $issue, 'sepatu' => Sepatu::all()]);
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
