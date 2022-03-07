<?php

namespace App\Repositories;


use App\Models\EpinProducts\EpinProduct;
use App\Models\Products;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class EpinProductRepository extends EloquentRepository
{
    protected $entity = EpinProduct::class;

    function save($request)
    {
        $data = ['error', 'error'];

        if ($request->get('id')) {

            $product = EpinProduct::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            $product = new EpinProduct();
            $action = 'created';
        }
        $product->old_id = $request->get('old_id');
        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->imgUrl = $request->get('imgUrl');
        $product->status = $request->boolean('statusIn');
        // $product->imgUrl = $request->input('imgUrl');
        $product->save();
        $newProduct = Products::where('product_id', $product->id)
            ->where('category_id', 2)
            ->where('supplier_id', 2)
            ->first();
        if (!$newProduct) {
            $newProduct = new Products();
            $newProduct->product_id = $product->id;
            $newProduct->category_id = 2;
            $newProduct->supplier_id = 2;
            $newProduct->save();
        }


        if ($product) {
            $data = ['success' => 'Product ' . $action . ' successfully.'];
        }

        return $data;
    }
    function getList()
    {
        $data = EpinProduct::pluck('title','id');
        return $data;
    }
    function allData()
    {
        $data = EpinProduct::latest()->get();
        return $data;
    }
    function dataTable()
    {

        $data = [];
        $url =  route('epinProducts.store');
        $show =  '/epinProductEntities';



        $tokenCsrf = csrf_field();
        $rowData = EpinProduct::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'old_id' => $row->old_id,
                    'title' => $row->title,
                    'description' => $row->description,
                    'imgUrl' => $row->imgUrl,
                    'status' => $row->status,
                    'action' => '
                    <div class="button-block">
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btnRepo btn-outline-warning btn-sm"><i class="bx bx-edit"></i></a>
                                <form action="' . $show . '" id="formshow" name="formshow" method="GET" enctype="multipart/form-data">                             
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                                      
                                <button class="btn btnRepo btn-outline-success btn-sm"data-id="' . $row->id . '"><i class="bx bx-show"></i></button>                               
                                </form>

                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btnRepo delete btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a></div>'
                ];
            }
        }
        return $data;
    }
}
