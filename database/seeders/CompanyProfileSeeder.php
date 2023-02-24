<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;
class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
           //
                $payment =  new CompanyProfile();
                $payment->name = "";
                $payment->address = "";
                $payment->capital = "";
                $payment->phone = "";
                $payment->phone = "";
                $payment->email = "";
                $payment->NRC = "";
                $payment->NIF = "";
                $payment->NART = "";
                $payment->NIS = "";
                $payment->save();


    }
}
