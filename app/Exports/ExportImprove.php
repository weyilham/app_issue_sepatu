<?php

namespace App\Exports;

use App\Models\Issue;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportImprove implements FromCollection
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
        $data = Issue::orderBy('id', 'desc')->where('created_at', '>=', $this->awal)->where('created_at', '<=', $this->akhir)->where('status', 'Done')->get();
        return $data;
    }
}
