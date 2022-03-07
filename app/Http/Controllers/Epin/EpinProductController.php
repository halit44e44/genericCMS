<?php

namespace App\Http\Controllers\Epin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\EpinProducts\EpinProduct;
use App\Repositories\EpinProductRepository;

use Illuminate\Http\Request;

class EpinProductController extends Controller
{
    public function __construct(EpinProductRepository $productRepository)
    {
      $this->productRepo = $productRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
              'title' => __('product.mainTitle'),
            ],
            'dataTable' => [
              'source' => 'epinProducts',
              'columnsTitles' => [
                __('product.tableId'),
                __('product.tableOldId'),
                __('product.tableTitle'),
                __('product.tableDescription'),
                __('product.tableImgUrl'),
                __('product.tableStatus'),
              ],
              'columns' => [
                'DT_RowIndex',
                'old_id',
                'title',
                'description',
                'imgUrl',
                'status'
              ],
              'route' => 'epinProducts',
              'delete' => [
                'titleField' => 'title'
              ],
              'popup' => true,
              'edit' => [
                'columns' => [
                  'id',
                  'old_id',
                  'title',
                  'description',
                  'imgUrl',
                  'status'
                ]
              ]
            ],
      
          ];
      
          return view('epinProducts.index')->with('data', $data);
    }

    
    public function create()
    {
        //
    }

    
    public function store(ProductRequest $request)
    {
    
        $result = $this->productRepo->save($request);
        return redirect()->route('epinProducts.index')->with($result);
    }

   
    public function show($id)
    {
        $product = EpinProduct::find($id);
        return response()->json($product);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
      $product = EpinProduct::find($id);
      $product->delete();
      return redirect()->route('epinProducts.index')->with('success', 'Product deleted successfully');
    }
}
