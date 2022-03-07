<?php

namespace App\Repositories;

use App\Models\Genba\GenbaPrice;

use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenbaPriceRepository extends EloquentRepository
{
    protected $entity = GenbaPrice::class;

    function save($request)
    {
        $data = ['error', 'error'];
        if ($request->get('id')) {

            $genbaPrice = GenbaPrice::where('id', $request->get('id'))->first();

            $action = 'updated';
        } else {

            $genbaPrice = new GenbaPrice();
            $action = 'created';
        }

        $genbaPrice->productID = $request->get('productID');
        $genbaPrice->regionCode = $request->get('regionCode');
        $genbaPrice->currencyCode = $request->get('currencyCode');
        $genbaPrice->wsp = $request->get('wsp');
        $genbaPrice->srp =  $request->get('srp');
        $genbaPrice->isPromotion =  $request->get('isPromotion');

        $genbaPrice->save();

        if ($genbaPrice) {
            $data = ['success' => 'Genba Price' . $action . ' successfully.'];
        }

        return $data;
    }
    function getPrice($id){

        $genbaPrice = GenbaPrice::where('product_id',$id)->get();
        return $genbaPrice;
    }
    function allData()
    {
        $data = GenbaPrice::latest()->get();
        return $data;
    }


    function dataTable($id)
    {
        $data = [];
        $rowData = GenbaPrice::where('product_id',$id)->latest()->get();
        $url =  route('genbaProducts.store');
        $show =  '/genbaProducts/details';

        $tokenCsrf = csrf_field();

        if (count($rowData) > 0) {
            foreach ($rowData as $row) {

                $data[] = [
                    'id' => $row->id,
                    'regionCode' => $row->regionCode,
                    'currencyCode' => $row->currencyCode,
                    'wsp' => $row->wsp,
                    'srp' => $row->srp,
                    'isPromotion' => $row->isPromotion,
                    'action' => '<form action="' . $url . '"id="form" method="POST" enctype="multipart/form-data">  
                                ' . $tokenCsrf . '
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                                      
                                <button class="btn btn-outline-warning btn-sm"><i class="checkBtn bx bx-edit"></i></button>                               
                                </form>

                                <form action="' . $show . '" id="formshow" name="formshow" method="GET" enctype="multipart/form-data">                             
                                <input type="hidden" name="id" data-id="' . $row->id . '" value="' . $row->id . '">                                                      
                                </form>
                                <a href="javascript:void(0)" id="delete" data-id="' . $row->id . '" class="btn btn-outline-danger btn-sm"><i class="checkBtn bx bx-trash"></i></a>'
                ];
            }
        }
        return $data;
    }
}
