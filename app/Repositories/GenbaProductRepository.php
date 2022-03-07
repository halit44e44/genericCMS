<?php

namespace App\Repositories;

use App\Models\Genba\GenbaProducts;
use Carbon\Carbon;


use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenbaProductRepository extends EloquentRepository
{
    protected $entity = GenbaProducts::class;

    function save($request)
    {
        $data = ['error', 'error'];
        if ($request->get('id')) {

            $genbaProduct = GenbaProducts::where('id', $request->get('id'))->first();

            $action = 'updated';
        } else {

            $genbaProduct = new GenbaProducts();
            $action = 'created';
        }

        $genbaProduct->productID = $request->get('productID');
        $genbaProduct->sku = $request->get('sku');
        $genbaProduct->regionCode = $request->get('regionCode');
        $genbaProduct->isBundle = $request->get('isBundle');
        $genbaProduct->name = $request->get('name');
        $genbaProduct->status =  $request->get('status');
        $genbaProduct->details_sync =  $request->get('details_sync');
        $genbaProduct->price_sync = $request->get('price_sync');
        $genbaProduct->tr_price = $request->get('tr_price');
        $genbaProduct->en_price = $request->get('en_price');
        $genbaProduct->eur_price = $request->get('eur_price');

        $genbaProduct->save();

        if ($genbaProduct) {
            $data = ['success' => 'Genba ' . $action . ' successfully.'];
        }

        return $data;
    }
    function allData()
    {
        $data = GenbaProducts::latest()->get();
        return $data;
    }

    function getProductDetails($id)
    {
        $genbaProduct = GenbaProducts::where('id', $id)->with(['languages','genbaGraphics','genbaPrice','genbaGameLanguage','genbaInstruction','genbaAgeRestriction','genbaVideo','restriction'])->first();
        return $genbaProduct;
    }

    function genbaGetProduct($genbaProductId,$id)
    {
        // $genbaProduct = GenbaProducts::where('id', $id)->first();

        $getProduct = GenbaProducts::where('productID',$genbaProductId)->where('id','!=',$id)->get();
        return $getProduct;
        

    }

    function dataTable()
    {
        $data = [];
        $rowData = GenbaProducts::where('status', 'active')->groupBy('productID')->get();
        $url =  route('genbaProducts.store');
        $show =  '/genbaProducts/details';

        $tokenCsrf = csrf_field();

        if (count($rowData) > 0) {
            foreach ($rowData as $row) {

                $data[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'sku' => $row->sku,
                    'isBundle' => $row->isBundle,
                    'status' => $row->status,
                    'created_at' => $row->created_at->toDateTimeString(),
                    'updated_at' => $row->updated_at->toDateTimeString(),

                    'action' => '<div class="button-block"><form action="' . $url . '"id="form" method="POST" enctype="multipart/form-data">  
                                ' . $tokenCsrf . '
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                                      
                                <button class="btn btnRepo btn-outline-warning btn-sm" data-id="' . $row->id . '"><i class="bx bx-edit"></i></button>                               
                                </form>

                                <form action="' . $show . '" id="formshow" name="formshow" method="GET" enctype="multipart/form-data">                             
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                        
                                <button class="btn btnRepo btn-outline-success btn-sm"data-id="' . $row->id . '"><i class="bx bx-show"></i></button>                               


                                </form>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btnRepo btn-outline-danger btn-sm"><i class="bx bx-trash"></i></a></div>'
                ];
            }
        }
        return $data;
    }
}
