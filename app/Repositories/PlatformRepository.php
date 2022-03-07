<?php

namespace App\Repositories;

use App\Models\Platform;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class PlatformRepository extends EloquentRepository
{
    protected $entity = Platform::class;

    function save($request)
    {
        $data = ['error', 'error'];
        
        if ($request->get('id')) {
        
            $platform = Platform::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $platform = new Platform();
            $action = 'created';
        }

        $platform->name = $request->get('name');
       
        $platform->save();

        if ($platform) {
            $data = ['success' => 'Platform ' . $action . ' successfully.'];
        }

        return $data;
    }
    function allData()
    {
        $data = Platform::latest()->get();
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Platform::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm">Edit</a>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btn-outline-danger btn-sm">Delete</a>'
                ];
            }
        }
        return $data;
    }
}
