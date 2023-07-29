<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $csvFile = fopen(base_path("database/data/2-group.csv"), "r");

        $firstline = true;

        $arrNamaColumn = [];
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if ($firstline) {
                foreach ($data as $idx => $namaColumn) {
                    array_push($arrNamaColumn, $namaColumn);
                }
                $firstline = false;
                continue;
            }

            $arrCreate = [];
            foreach ($arrNamaColumn as $idx => $namaColumn) {
                $arrCreate[$namaColumn] = $data[$idx] == 'null' ? null : $data[$idx];
            }

            Group::create($arrCreate);
        }

        fclose($csvFile);
    }
}
