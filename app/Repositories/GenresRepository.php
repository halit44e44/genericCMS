<?php

namespace App\Repositories;

use App\Models\Genres;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenresRepository extends EloquentRepository
{
    protected $entity = Genres::class;

    function save($request)
    {
        $data = ['error', 'error'];
        
        if ($request->get('id')) {
        
            $platform = Genres::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $platform = new Genres();
            $action = 'created';
        }

        $platform->name = $request->get('name');
       
        $platform->save();

        if ($platform) {
            $data = ['success' => 'Genres ' . $action . ' successfully.'];
        }

        return $data;
    }
    function allData()
    {
        $data = Genres::latest()->get();
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Genres::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm"><i class="bx bx-edit"></i></a>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a>'
                ];
            }
        }
        return $data;
    }
}
