<?php

namespace App\Exports;

use App\Models\Issue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportIssue implements FromCollection
{
    public $awal;
    public $akhir;
    public function __construct($awal, $akhir)
    {
        $this->awal = $awal;
        $this->akhir = $akhir;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //
        $tgl_awal = Carbon::parse($this->awal)->startOfDay();
        $tgl_akhir = Carbon::parse($this->akhir)->endOfDay();
        // $data = Issue::orderBy('id', 'desc')->where('created_at', '>=', $tgl_awal)->where('created_at', '<=', $tgl_akhir)->orderBy('id', 'desc')->where('status', 'Done')->get();

        $results = DB::table('issues')
            ->join('artikels', 'artikels.id', '=', 'issues.artikel_id')
            ->join('sepatus', 'sepatus.id', '=', 'artikels.sepatu_id')
            ->select(
                'sepatus.nama_merk',
                'artikels.nama_artikel',
                'issues.tgl_issue',
                'issues.gambar',
                'issues.deskripsi',
                'issues.status'
            )
            ->whereBetween('issues.created_at', [$tgl_awal, $tgl_akhir])
            ->orderBy('issues.id', 'desc')
            ->get();
        return $results;
    }
}
