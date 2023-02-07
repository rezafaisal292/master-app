<?php

namespace Modules\MasterCabang\Imports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\MasterCabang\Entities\MasterCabang;
use Ramsey\Uuid\Uuid;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class MasterCabangImport implements ToCollection, WithHeadingRow
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $now = now();
        foreach ($collection as $collect) {
            MasterCabang::where('kodecabang',$collect['kodecabang'])->delete();
         
            \Illuminate\Support\Facades\DB::table('app_master_cabang')->insert([
                'kodecabang' => $collect['kodecabang'],
                'namacabang' => $collect['namacabang'],
                'kodeinduk' => $collect['kodeinduk'],
                'kodekanwil' => $collect['kodekanwil'],
                'status' => $collect['status'],
                'created_at'=>$now,
                'updated_at'=>$now,
            ]);

        
        }
    }
}
