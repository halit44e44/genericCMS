<?php

namespace App\Repositories;

use App\Models\Category;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
     protected $entity = Category::class;

     function save($request)
    {
        $data = ['error', 'error'];
        if ($request->get('id')) {
            $category = Category::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
          $category = new Category();
            $action = 'created';
        }

        $category->title = $request->get('title');
        $category->description = $request->get('description');
     //    $category->imgUrl = $request->get('imgUrl');
        $category->parent_id = $request->get('parent_id');
        // $category->status= $request->get('status');
        $category->save();

        if ($category) {
            $data = ['success' => 'Category ' . $action . ' successfully.'];
        }

        return $data;
    }
    function allData()
    {
        $data = Category::latest()->get();
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Category::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'title' => $row->title,
                    'description' => $row->description,
                    // 'imgUrl'=>$row->imgUrl,
                    'parent_id'=>$row->parent_id,
                    // 'status'=>$row->status,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm"><i class="bx bx-edit"></i></a>
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn delete btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a>'
                ];
            }
        }
        return $data;
    }

}
