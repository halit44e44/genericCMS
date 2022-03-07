<?php

namespace App\Http\Controllers\Genba;

use App\Http\Controllers\Controller;
use App\Models\Genba\GenbaOrderLogs;
use App\Models\GenbaOrderLogsShred;
use App\Repositories\GenbaOrderLogsShredRepository;
use Illuminate\Http\Request;

class GenbaOrderLogsShredController extends Controller
{
    public function __construct(GenbaOrderLogsShredRepository $genbaOrderLogsShredRepository)
    {
      $this ->genbaOrderLogsShredRepo = $genbaOrderLogsShredRepository;
    }
    public function index()
    {
    
       $this->genbaOrderLogsShredRepo->saveOrder();

       $data = [
        'breadcrumb' => [
          'title' => __('logsShred.mainTitle'),
        ],
        'dataTable' => [
          'source' => 'genbaOrderLogsShred',
          'columnsTitles' => [
            '#',
            __('logsShred.tableId'),
            __('logsShred.productName'),
            // __('logsShred.productCode'),
            __('logsShred.genbaOrderNo'),
            __('logsShred.productSelNet'),
            __('logsShred.productSelGross'),
            __('logsShred.productSelCurrency'),
            __('logsShred.productAcAmount'),
            __('logsShred.productAcCurrency'),         
            __('logsShred.created'),
          ],
          'columns' => [
            'DT_RowIndex',
            'id',
            'productName',
            // 'productCode',
            'genba_product_id',
            'productSelNet',
            'productSelGross',
            'productSelCurrency',
            'productAcAmount',
            'productAcCurrency',
            'created',

          ],
          'route' => 'genbaOrderLogsShred',
          'delete' => [
            'titleField' => 'title'
          ],
          'popup' => true,
          'edit' => [
            'columns' => [
              'id',
            ]
          ]
        ],
  
      ];
  
      return view('genba.orderLogsShred.index')->with('data', $data);

    }

    public function show($id)
    {
        $data=[];
        $temp =  GenbaOrderLogsShred::whereId($id)->with(['genbaProduct','genbaOrderLog.genbaClientToken.clientInfo'])->first();
        
        foreach (json_decode($temp->keys) as $item) {
            
        }
  
        if($temp){
          $data = [
            'code'=>$item->Code,
            'sku' =>$temp->sku,
            'genbaCreated'=>$temp->order_created_time,
            'clientTransId'=>$temp->client_transaction_id,
            // 'cName'=>$temp->genbaOrderLog->genbaClientToken->clientInfo->name,
            // 'cEmail'=>$temp->genbaOrderLog->genbaClientToken->clientInfo->email,
            // 'cPhone'=>$temp->genbaOrderLog->genbaClientToken->clientInfo->phone,
            'cIp'=>$temp->genbaOrderLog->genbaClientToken->ip,
            'cId'=>$temp->genbaOrderLog->genbaClientToken->user_id

  
          ];
        }
  
        return response()->json($data);
    }

}
