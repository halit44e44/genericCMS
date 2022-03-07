<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Models\StockCode;
use App\Models\StockProductEntities;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class EpinStockRepository extends EloquentRepository
{
    protected $entity = Stock::class;
    function save($request)
    {
        $data = ['error', 'error'];

        $stock = new Stock();
        $stock->supplier_id = $request->get('supplier_id');
        $stock->price = $request->get('price');
        $action = 'created';
        // dd($request);
        $stock->save();
        if ($stock) {
            foreach ($request->get('epinEntities') as $item) {
                $productEntity = new StockProductEntities();
                $productEntity->stock_id = $stock->id;
                $productEntity->productEntity_id = $item;
                $productEntity->save();
            }
            $tempArr = preg_split('/[\s\n\r]+/', $request->get('code'));
            // dd($tempArr);
            $x = 0;
            foreach ($tempArr as $items) {
                $data = new StockCode();
                $data->stock_id = $stock->id;
                $data->code = $items;
                $data->save();
                if ($data) {
                    $x++;
                }
            }
            $stock->stock_count = $x;
            $stock->available_count = $x;
            $stock->save();
        }

        if ($stock) {
            $data = ['success' => 'Epin Stock ' . $action . ' successfully.'];
        }
        return $data;
    }
    function dataTable()
    {
        $data = [];
        $rowData = Stock::with(['supplier','stockProductEntity.epinProductEntity',])->latest()->get();

        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $productEntitiesNames = '';
                if (count($row->stockProductEntity) > 0) {
                    foreach ($row->stockProductEntity as $productEntity) {
                        $productEntitiesNames .= $productEntity->epinProductEntity->epinProduct->title . ': ' . $productEntity->epinProductEntity->title . ' ';
                    }
                }
                $data[] = [
                    'id' => $row->id,
                    'supplier_id' => $row->supplier->title,
                    'stock_product_entity' => $productEntitiesNames,
                    'price' => $row->price,
                    'stock_count' => $row->stock_count,
                    'available_count' => $row->available_count,
                    'status' =>$row->status,
                    'created_at' => $row->created_at->toDateTimeString(),
                    'action' => 
                                '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn delete btn-outline-danger btn-sm">Delete</a>'
                ];
            }
        }
        return $data;
    }
}
