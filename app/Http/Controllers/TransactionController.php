<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Flag;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
  public function __construct(TransactionRepository $transactionRepository)
  {
    $this->transactionRepo = $transactionRepository;
  }

    public function index(Request $request) 
    {
      $flags = Flag::whereIn('keys',['wait','preorder'])->get();
      $status = null;
      if($request)
      {
        $status = $request->status;
      }
        {
            $data = [
              'breadcrumb' => [
                
                'title' => __('transaction.mainTitle'),
              ],
              'dataTable' => [
                'status'=>$status,
                'source' => 'transaction',
                'columnsTitles' => [
                  
                  __('transaction.tableId'),
                  __('transaction.transactionId'),
                  __('transaction.companyId'), 
                  __('transaction.epinProductEntity'), 
                  // __('transaction.client'), 
                  __('transaction.qty'), 
                  __('transaction.singlePrice'), 
                  __('transaction.totalPrice'), 
                  __('transaction.status'),
                  __('transaction.date'),
                ],
                'columns' => [
                  'DT_RowIndex',
                  'transactionId',
                  'company_id',
                  'epinProduct_entity_id',
                  // 'client_info_id',
                  'qty',
                  'single_price',
                  'total_price',
                  'status',
                  'created_at',
                ],
                'route' => 'transactions',
                'delete' => [
                  'titleField' => 'title'
                ],
                'popup' => true,
              
              ],
        
            ];
        
            return view('transactions.index')->with('data', $data)->with('flags',$flags);
          }
    }

    public function create()
    {
        //
    }

    public function store(TransactionRequest $request)
    {
        $result = $this->transactionRepo->save($request);

        return redirect()->route('transactions.index');
    }

    public function show($id)
    {
      $data=[];
      $temp =  Transaction::whereId($id)->with(['companies','clientInfo'])->first();
      // dd($temp);

      if($temp){
        $data = [
          'soldCodes'=>json_decode($temp->soldCodes),
          // 'single_price'=>$temp->single_price,
          'percentage'=>$temp->percentage,
          'percentage_single_price'=>$temp->percentage_single_price,
          'percentage_total_price'=>$temp->percentage_total_price,
          'cName'=>$temp->clientInfo->name,
          'cEmail'=>$temp->clientInfo->email,
          'cPhone'=>$temp->clientInfo->phone,
          'cIp'=>$temp->clientInfo->ip,



        ];
      }

      return response()->json($data);

        // $transactions = Transaction::find($id);
        // return response()->json($transactions);
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
        $transactions = Transaction::find($id);
        $transactions->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction is deleted successfully');
    }

    

}
