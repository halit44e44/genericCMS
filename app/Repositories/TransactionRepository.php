<?php

namespace App\Repositories;

use App\Models\Transaction;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class TransactionRepository extends EloquentRepository
{
    protected $entity = Transaction::class; 

    function save($request)
    {
        //
    }
    function allData()
    {
        $data = Transaction::latest()->get();
        return $data;
    }

    function getList()
    {
        $data = Transaction::pluck('title','id');
        return $data;
    }
    function dataTable($status)
    {    
        $data = [];
        $rowData = Transaction::with(['companies','epinProductEntity','clientInfo'])->where(function($q) use ($status){
            if(isset($status)){
                $q->where('status',$status);
            }})->latest()->get();

        if (count($rowData) > 0) {
            foreach ($rowData as $row) {

                $item = null;
                if(isset($row->epinProductEntity->title)){
                    $item =$row->epinProductEntity->title; 
                }
                    $play = null;
                if ($status == 103 || $status==301) {              
                    $play = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn play btn-outline-success btn-sm"><i class="bx bx-check" style="margin:0;"></i></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn stop btn-outline-danger btn-sm"><i class="bx bx-x" style="margin:0px"></i></a></a>
                    ';
                }

                $data[] = [
                    'id' => $row->id,
                    'transactionId' => $row->transactionId,
                    'company_id' => $row->companies->title,
                    'epinProduct_entity_id' => $item,
                    'client_info_id' => $row->clientInfo->name,
                    'single_price' => $row->single_price,
                    'total_price' => $row->total_price,
                    'qty'=>$row->qty,
                    'status' => $row->status,
                    'soldCodes' => $row->soldCodes,
                    'created_at' => $row->created_at->toDateTimeString(),
                    
                    'action' => ' '.$play.'
                             
 
                                <a data-id="' . $row->id . '" class="btn details-control btn-outline-warning btn-sm"><i class="bx bx-down-arrow-alt" style="margin:0;"></i></a>'
                ];
            }
        }
        return $data;
    }
}
