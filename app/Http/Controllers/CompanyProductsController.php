<?php

namespace App\Models\EpinProducts\EpinProduct;

namespace App\Http\Controllers;


use App\Http\Requests\CompanyProductsRequest;
use App\Models\CompanyProducts;
use App\Repositories\CompanyProductsRepository;
use Illuminate\Http\Request;
use Log;

class CompanyProductsController extends Controller
{
    public function __construct(CompanyProductsRepository $companyProductRepository)
    {
        $this->companyProductRepo = $companyProductRepository;
    }

    public function index(Request $request)
    {
        $products = $this->companyProductRepo->allData();
        $companies = $this->companyProductRepo->allDataCompany();
        $companyProduct = $this->companyProductRepo->getOneData($request->get('id'));
        //dd($companyProduct);
        // $data = [
        //     'breadcrumb' => [
        //         'title' => __('company.mainTitle'),
        //     ],
        //     $product
        // ];
        // dd($request->all());
        
        return view('companiesProduct.index')->with([
            'products'=> $products,
            'companies'=> $companies,
            'companyId'=> $request->get('id'),
            'companyProduct'=>$companyProduct,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $result = $this->companyProductRepo->save($request);
        // return redirect()->route('companiesProduct.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companiesProduct = CompanyProducts::where('id',$id)->first();
        $companiesProduct->delete();
        return $id;
    }

    function saveCompanyProduct(Request $request)
    {
        $result = $this->companyProductRepo->save($request);
        return $result;
        // $this->companyProductRepo->save($request);

        dd($request);
    }
}
