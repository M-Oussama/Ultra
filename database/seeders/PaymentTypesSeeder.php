<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentTypes;
class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $payment =  new PaymentTypes();
        $payment->type = "Espéce";
        $payment->save();

        $payment =  new PaymentTypes();
        $payment->type = "Cheque";
        $payment->save();
    }
}
