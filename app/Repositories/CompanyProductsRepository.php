<?php

namespace App\Repositories;

use App\Models\EpinProducts\EpinProduct;
use App\Models\Companies\Company;
use App\Models\CompanyProducts;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class CompanyProductsRepository extends EloquentRepository
{
    protected $entity = EpinProduct::class;
    protected $entityCompany = Company::class;
    protected $entityCompanyProduct = CompanyProducts::class;

    public static function save($request)
    {
        if ($request->get('id')) {
            $companyProduct = CompanyProducts::where('id', $request->get('id'))->delete();
            dd($request->all());
        } elseif ($companyProduct = CompanyProducts::where('company_id', $request->get('data')['company_id'])->where('product_id', $request->get('data')['product_id'])->first()) {
            $companyProduct = CompanyProducts::where('company_id', $request->get('data')['company_id'])->where('product_id', $request->get('data')['product_id'])->first();
            $action = 'upload';
        } else {
            $companyProduct = new CompanyProducts();
            $action = 'action';
            $item = $request->get('data');
            $companyProduct->company_id = $item['company_id'];
            $companyProduct->product_id = $item['product_id'];
            $companyProduct->percentage  = $item['percentage'];
            $companyProduct->save();
            return $companyProduct->id;
        }
        $item = $request->get('data');
        $companyProduct->company_id = $item['company_id'];
        $companyProduct->product_id = $item['product_id'];
        $companyProduct->percentage = $item['percentage'];
        $companyProduct->save();

        return $request->get('data');


        // $i = 1;
        // dd($request->all());
        // foreach($request as $item) {
        //     if($item->get('cbItem'.$i)) {
        //         $companyProduct = new CompanyProducts();
        //         $companyProduct->company_id = $item->get('companyId');
        //         $companyProduct->product_id = $item->get($i);
        //         $companyProduct->percentage = $item->get('percentItem'.$i);
        //         $companyProduct->save();
        //     }
        //     $i++;
        // }
        // if($companyProduct) {
        //     $data = ['success' => 'Company Product' . $action . ' succesfully.'];
        // };
    }

    public static function getOneData($id)
    {
        $companyPeoducts = CompanyProducts::where('company_id', $id)->get();
        return $companyPeoducts;
    }

    function allDataCompany()
    {
        $data = Company::latest()->get();
        //$data = Company::where('status',1)->orderby('id','DESC')->pluck('title','id');
        //dd($data);
        return $data;
    }

    function allData()
    {
        $data = EpinProduct::latest()->get();
        return $data;
    }
}
