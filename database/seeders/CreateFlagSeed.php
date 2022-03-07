<?php

namespace Database\Seeders;

use App\Models\Flag;
use Illuminate\Database\Seeder;

class CreateFlagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $flag= new Flag();
        $flag->id=1;
        $flag->keys='wait';
        $flag->value='0';
        $flag->note='0';
        $flag->save();

        $flag= new Flag();
        $flag->id=2;
        $flag->keys='preorder';
        $flag->value='0';
        $flag->note='0';
        $flag->save();

        $flag= new Flag();
        $flag->id=3;
        $flag->keys='cancel';
        $flag->value='0';
        $flag->note='0';
        $flag->save();

        $flag= new Flag();
        $flag->id=1;
        $flag->keys='success';
        $flag->value='0';
        $flag->note='0';
        $flag->save();
    }
}
