<?php

namespace App\Http\Controllers\Genba;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenbaProductRequest;
use App\Models\Genba\GenbaMetaData;
use App\Models\Genba\GenbaProductDetails;
use App\Models\Genba\GenbaProducts;
use App\Repositories\GenbaMetaDataRepository;
use App\Repositories\GenbaPriceRepository;
use App\Repositories\GenbaProductRepository;
use Illuminate\Http\Request;

class GenbaProductController extends Controller
{

    public function __construct(
        GenbaProductRepository $genbaProductRepository,
        GenbaPriceRepository $genbaPriceRepository,
        GenbaMetaDataRepository $genbaMetaDataRepository
    ) {
        $this->genbaProductRepo = $genbaProductRepository;
        $this->genbaPriceRepo = $genbaPriceRepository;
        $this->genbaMetaDataRepo = $genbaMetaDataRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
                'title' => __('genbaProduct.mainTitle'),
            ],
            'dataTable' => [
                'source' => 'genbaProducts',
                'columnsTitles' => [
                    '#',
                    __('genbaProduct.tableId'),
                    __('genbaProduct.tableName'),
                    __('genbaProduct.tableSku'),
                    __('genbaProduct.tableisBundle'),
                    __('genbaProduct.tableStatus'),
                    __('genbaProduct.tableCreated_at'),
                    __('genbaProduct.tableUpdated_at'),
                ],
                'columns' => [
                    'DT_RowIndex',  
                    'id',                
                    'name',
                    'sku',
                    'isBundle',
                    'status',         
                    'created_at',
                    'updated_at',
                                       
                ],
                'route' => 'genbaProducts',
                'delete' => [
                    'titleField' => 'name'
                ],
                'popup' => true,
                'edit' => [
                    'columns' => [
                        'id',
                        'name',
                        'sku',
                        'isBundle',
                        'status',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ],

        ];

        return view('genba.products.index')->with('data', $data);
    }


    public function create()
    {
        return view('genba.products.createOrUpdate');
    }
    public function store(Request $request)
    {

        if (isset($_POST["btnSubmit"])) {
            $result = $this->genbaProductRepo->save($request);
            return redirect()->route('genbaProducts.index')
                ->with($result);
        }

        $genbaProducts = GenbaProducts::where('id', $request->id)->first();

        return view('genba.products.createOrUpdate')->with('genbaProducts', $genbaProducts);
    }


    public function show(Request $request)
    {
        $genbaProduct = $this->genbaProductRepo->getProductDetails($request->get('id'));
        if(!$genbaProduct)
        {
            return view('auth.error404');
        }
        $genbaPrice = $this->genbaPriceRepo->getPrice($request->get('id'));
        $genbaGetProduct = $this->genbaProductRepo->genbaGetProduct($genbaProduct->productID,$request->get('id'));
        $genbaMetaData = $this->genbaMetaDataRepo->getMetaData($request->get('id'));
        $productDetails = GenbaProductDetails::where('product_id',$request->id)->with(['developer','publisher'])->first();

        
        

        return view('genba.products.detail')
        ->with('genbaProduct',$genbaProduct)
        ->with('productDetails',$productDetails)
        ->with('genbaPrice',$genbaPrice)
        ->with('genbaGetProduct',$genbaGetProduct)
        ->with('genbaMetaData',$genbaMetaData);
    }

    public function edit($id)
    {
        //
    }

    public function update(GenbaProductRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $genbaProduct = GenbaProducts::find($id);
        $genbaProduct->delete();
        return redirect()->route('genbaProducts.index')->with('success', 'Genba Product deleted successfully');
    }
}
