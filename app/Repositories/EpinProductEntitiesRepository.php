<?php

namespace App\Repositories;


use App\Models\EpinProducts\EpinProductEntities;
use App\Models\Products;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class EpinProductEntitiesRepository extends EloquentRepository
{
    protected $entity = EpinProductEntities::class;

    function save($request)
    {
        $data = ['error', 'error'];

        if ($request->get('id')) {

            $product = EpinProductEntities::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $product = new EpinProductEntities();
            $action = 'created';
        }
        $product->epinProduct_id = $request->get('epinProduct_id');
        $product->title = $request->get('title');
        $product->old_id = $request->get('old_id');
        $product->stock_code = $request->get('stock_code');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->status = $request->boolean('statusIn');
        $product->accounting_code = $request->get('accounting_code');
        $product->save();


        if ($product) {
            $data = ['success' => 'Product Entity ' . $action . ' successfully.'];
        }

        return $data;
    }
    function getList()
    {
        $data = EpinProductEntities::pluck('title','id');
        return $data;
    }
    function getListByIds($ids)
    {
        $data = EpinProductEntities::whereIn('epinProduct_id',$ids)->pluck('title','id');
        return $data;
    }
    function allData()
    {
        $data = EpinProductEntities::latest()->get();
        return $data;
    }
    static function dataTable($id)
    {
       
        $data = [];
        $rowData = EpinProductEntities::where('epinProduct_id',$id)->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'title' => $row->title,
                    'description' => $row->description,
                    'stock_code' => $row->stock_code,
                    'price' => $row->price,
                    'accounting_code' => $row->accounting_code,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm"><i class="bx bx-edit"></i></a>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a>'
                ];
            }
        }
        return $data;
    }
}
