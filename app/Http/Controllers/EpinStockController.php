<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpinStockRequest;
use App\Models\Stock;
use App\Models\StockCode;
use App\Models\StockProductEntities;
use App\Repositories\EpinProductEntitiesRepository;
use App\Repositories\EpinProductRepository;
use App\Repositories\EpinStockRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class EpinStockController extends Controller
{

    public function __construct(
        EpinStockRepository $epinStockRepository,
        EpinProductRepository $epinProductRepository,
        EpinProductEntitiesRepository $epinProductEntitiesRepository,
        SupplierRepository $supplierRepository

    ) {
        $this->epinStockRepo = $epinStockRepository;
        $this->epinProductRepo = $epinProductRepository;
        $this->epinProductEntitiesRepo = $epinProductEntitiesRepository;
        $this->supplierRepo = $supplierRepository;
    }
    public function index()
    {
        $data = [
            'breadcrumb' => [
              'title' => __('epinStocks.mainTitle'),
            ],
            'dataTable' => [
              'source' => 'Stock',
              'columnsTitles' => [
                __('epinStocks.tableId'),
                __('epinStocks.tableSupplier'),
                __('epinStocks.tableStockProductEntity'),
                __('epinStocks.tablePrice'),
                __('epinStocks.tableStockCount'),
                __('epinStocks.tableAvailableCount'),
                // __('epinStocks.tableStatus'),
                __('epinStocks.tableCreated'),

              ],
              'columns' => [
                'DT_RowIndex',
                'supplier_id',
                'stock_product_entity',
                'price',
                'stock_count',
                'available_count',
                // 'status',
                'created_at',

              ],
              'route' => 'epinStocks',
              'delete' => [
                'titleField' => 'stock_count'
              ],
              'popup' => true,
              'edit' => [
                'columns' => [
                  'id',
                  'supplier_id',
                  'price',
                  'stock_count',
                  'available_count',
                  // 'status',
                  'created_at'
                ]
              ]
            ],
     
          ];
      
          return view('epinStocks.index')->with('data', $data);
    }


    public function create()
    {
    
        $products = $this->epinProductRepo->getList();
        $suppliers = $this->supplierRepo->getList();
        // dd($suppliers);
        return view('epinStocks.createOrUpdate')->with('products', $products)->with('suppliers',$suppliers);
    }

    public function productEntity(Request $request)
    {   
        return $this->epinProductEntitiesRepo->getListByIds($request->get('epinProduct_id'));
  
    }

    public function store(EpinStockRequest $request)
    {
        
        $result = $this->epinStockRepo->save($request);
        return redirect()->route('epinStocks.index')->with($result);
    }

    public function show($id)
    {
        $stock = Stock::find($id);
        return response()->json($stock);
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
        $stock = Stock::where('id',$id)->first();

        if ($stock->stock_count == $stock->available_count)
        {   
            $stock = Stock::where('id',$id)->delete();
            $stock = StockCode::where('stock_id',$id)->delete();
            $stock = StockProductEntities::where('stock_id',$id)->delete();          
            return redirect()->route('epinStocks.index')->with('success', 'Stock deleted successfully');
        }

        StockCode::where('stock_id',$id)->where('status',1)->delete();

        $soldCodes=StockCode::where('stock_id',$id)->where('status',0)->pluck('id');
        $stock->stock_count=count($soldCodes);
        $stock->available_count=0;
        $stock->save();
        return redirect()->route('epinStocks.index');
    
       
    }
}
