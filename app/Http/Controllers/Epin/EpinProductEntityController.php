<?php

namespace App\Http\Controllers\Epin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpinProductEntitiesRequest;
use App\Models\EpinProducts\EpinProduct;
use App\Models\EpinProducts\EpinProductEntities;
use App\Repositories\EpinProductEntitiesRepository;
use Illuminate\Http\Request;

class EpinProductEntityController extends Controller
{
    public function __construct(EpinProductEntitiesRepository $epinProductEntitiesRepository)
    {
      $this->epinProductEntitiesRepo = $epinProductEntitiesRepository;
    }
    
    public function index(Request $request)
    {
     
        $id = $request->id;
        
        if (isset($request->id)) {
          
          $product = EpinProduct::where('id',$id)->first();
          
          
        } 
        if($product)
        {
          $data = [
            'breadcrumb' => [
              'title' => __('epinProductEntities.mainTitle'),
            ],
            'dataTable' => [
              'queryId'=>$product->id,
              'source' => 'epinProductEntities',
              'columnsTitles' => [
                __('epinProductEntities.tableId'),
                __('epinProductEntities.tableTitle'),
                __('epinProductEntities.tableDescription'),
                __('epinProductEntities.tableStock_code'),
                __('epinProductEntities.tablePrice'), 
                __('epinProductEntities.tableAccounting_code'),
                
              ],
              'columns' => [
                'DT_RowIndex',
                'title',
                'description',
                'stock_code',
                'price',
                'accounting_code',

              ],
              'route' => 'epinProductEntities',
              'delete' => [
                'titleField' => 'title'
              ],
              'popup' => true,
              'edit' => [
                'columns' => [
                  'id',
                  'title',
                  'description',
                  'stock_code',
                  'price',
                  'accounting_code'
                ]
              ]
                
            ],
             'productDetails'=>$product,
          ];
          return view('epinProductEntities.index')->with('data', $data);
        }
        return 404;
      
          

    }

    public function create()
    {
        //
    }

   
    public function store(EpinProductEntitiesRequest $request)
    {
      
      $result = $this->epinProductEntitiesRepo->save($request);
      $request->query('id', $request->get('epinProduct_id'));
      //dd($productId);
      //$result='';
      return redirect()->back()->with('success', 'Action successfully');
    }

  
    public function show($id)
    {
      
      $product = EpinProductEntities::find($id);
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
      $product = EpinProductEntities::find($id);
      $product->delete();
      return redirect()->route('epinProductEntites.index')->with('success', 'Product deleted successfully');
    }

    // public function productEntity(Request $request){


    //     // $entity = EpinProductEntities::where("epinProduct_id",$request->epinProduct_id)->pluck(["name","id"]);

    //     // return response()->json($entity);
    //     $data['productEntities'] = EpinProductEntities::where("epinProduct_id",$request->epinProduct_id)->get(["name", "id"]);
    //     dd($data);
    //     return response()->json($data);
    // }
}
