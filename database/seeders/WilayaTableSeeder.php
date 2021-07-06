<?php

namespace Database\Seeders;

use App\Models\Baladia;
use App\Models\Daira;
use App\Models\Wilaya;
use Illuminate\Database\Seeder;

class WilayaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonString = file_get_contents(base_path('database/seeders/algeria-cities.json'));
        $data = json_decode($jsonString);

        foreach ($data->wilayas as $wilaya){
            $wilaya_new = new Wilaya();
            $wilaya_new->WILAYA = $wilaya->code;
            $wilaya_new->name_ar = $wilaya->name_ar;
            $wilaya_new->name_fr = $wilaya->name;
            $wilaya_new->zip = $wilaya->code.'000';
            $wilaya_new->save();

            foreach ($wilaya->dairas as $daira){
                $daira_new = new Daira();
                $daira_new->DAIRA = $daira->code;
                $daira_new->name_ar = $daira->name_ar;
                $daira_new->name_fr = $daira->name;
                $wilaya_new->zip = $wilaya->code.$daira->code;
                $daira_new->wilaya_id = $wilaya_new->id;
                $daira_new->save();

                if (!empty($daira->communes)){

                    foreach ($daira->communes as $baladia){
                        $baladia_new = new Baladia();
                        $baladia_new->BALADIA = $baladia->code;
                        $baladia_new->name_ar = $baladia->name_ar;
                        $baladia_new->name_fr = $baladia->name;
                        $baladia_new->daira_id = $daira_new->id;
                        $baladia_new->save();
                    }
                }
            }
        }
    }
}
