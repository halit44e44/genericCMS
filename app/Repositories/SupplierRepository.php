<?php

namespace App\Repositories;

use App\Models\Supplier;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class SupplierRepository extends EloquentRepository
{
    protected $entity = Supplier::class;

    function save($request)
    {
        $data = ['error', 'error'];
        
        if ($request->get('id')) {
        
            $supplier = Supplier::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $supplier = new Supplier();
            $action = 'created';
        }

        $supplier->title = $request->get('title');
        $supplier->description = $request->get('description');
        $supplier->save();

        if ($supplier) {
            $data = ['success' => 'Supplier ' . $action . ' successfully.'];
        }

        return $data;
    }
    function allData()
    {
        $data = Supplier::latest()->get();
        return $data;
    }

    function getList()
    {
        $data = Supplier::pluck('title','id');
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Supplier::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'title' => $row->title,
                    'description' => $row->description,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btnRepo btn-outline-warning btn-sm"><i class="bx bx-edit btnRepo"></i></a>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btnRepo delete btn-outline-danger btn-sm"><i class="bx bx-trash btnRepo"></i></a>'
                ];
            }
        }
        return $data;
    }
}
