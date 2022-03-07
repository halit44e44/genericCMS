<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CreateCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category=new Category;
        $category->id=1;
        $category->title=json_encode(['en'=>'Cd-Keys','tr'=>'Cd-Keys']);
        $category->description=json_encode(['en'=>'','tr'=>'']);
        $category->imgUrl='';
        $category->save();
    }
}
