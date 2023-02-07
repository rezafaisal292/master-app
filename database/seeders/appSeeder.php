<?php

namespace Database\Seeders;

use Modules\DataPorsi25\Imports\DataPorsi25Import;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\DataPorsi25\Entities\DataPorsi25;
use Spatie\Permission\Models\Role;

use Maatwebsite\Excel\Facades\Excel;
use Modules\MasterCabang\Entities\MasterCabang;
use Modules\MasterCabang\Imports\MasterCabangImport;

class appSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        

        $mstPage = [
                [
                'id' => Uuid::uuid4(), 'nama' => 'Master Cabang', 'url' => 'mastercabang', 'icon' => 'fas fa-fw fa-book', 'parent' => null,
                'urutan' => 3, 'status' => '1', 'childs' => []
                ],
                // [
                // 'id' => Uuid::uuid4(), 'nama' => 'Master Data', 'url' => '#', 'icon' => 'fas fa-fw fa-book', 'parent' => null,
                // 'urutan' => 4, 'status' => '1', 'childs' => 
                //     [
                //         [
                //             'id' => Uuid::uuid4(),
                //             'nama' => 'Child',
                //             'url' => 'child',
                //             'icon' => null,
                //             'urutan' => 1,
                //             'status' => '1',
                //             'created_at' => Carbon::now(),
                //             'updated_at' => Carbon::now(),
                //         ],
                        
                //     ],
                // ],
        ];

        foreach ($mstPage as $page) {
            $childs = $page['childs'];

            unset($page['childs']);
            \Modules\MasterPage\Entities\MasterPage::create($page);

            if (!empty($childs)) {
                $pageId = \Modules\MasterPage\Entities\MasterPage::findByName($page['nama']);

                foreach ($childs as $child) {
                    $child['parent'] = $pageId->id;
                    \Modules\MasterPage\Entities\MasterPage::create($child);
                }
            }
        }
        
        MasterCabang::truncate();
        (new MasterCabangImport)->import('database/data/MasterCabang.xlsx');
      
        
        
    }
}



      

