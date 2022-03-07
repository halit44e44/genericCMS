<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->id=1;
        $user->name='synchroniser';
        $user->email='sync@epin.com.com';
        $user->password=app('hash')->make('gh.sr4747');
        $user->token=app('hash')->make(uniqid());
        $user->save();

        $user=new User;
        $user->id=2;
        $user->name='epiSite';
        $user->email='siteclient@epin.com.tr';
        $user->password=app('hash')->make('v7_XffELt!XR');
        $user->token=app('hash')->make(uniqid());
        $user->save();
    }
}
