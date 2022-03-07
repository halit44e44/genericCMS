<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class CreateSupplierSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier= new Supplier;
        $supplier->id=1;
        $supplier->title='genba';
        $supplier->description='cd-Keys provider company';
        $supplier->save();
    }
}
