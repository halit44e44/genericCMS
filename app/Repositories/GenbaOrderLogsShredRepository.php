<?php

namespace App\Repositories;

use App\Models\Genba\GenbaOrderLogs;
use App\Models\GenbaOrderLogsShred;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class GenbaOrderLogsShredRepository extends EloquentRepository
{
    protected $entity = GenbaOrderLogsShred::class;

    function saveOrder()
    {
        $startId=0;
        $log_id = GenbaOrderLogsShred::latest('genba_order_logs_id')->first();

        if ($log_id) {
            $startId= $log_id->genba_order_logs_id;
        }
        $data = GenbaOrderLogs::where('id', '>',$startId )->get();
        if (count($data) > 0) {
            foreach ($data as $order) {
                $shred = new GenbaOrderLogsShred();

                $item = json_decode($order->order_log);

                $shred->genba_order_logs_id = $order->id;
                $shred->one_time_token = $order->one_time_token;
                $shred->genba_product_id = $item['ID'];
                $shred->sku = $item->Sku;
                $shred->keys = json_encode($item->Keys);
                $shred->state = $item->State;
                $shred->order_created_time = $item->Created;
                $shred->sel_net_amount = $item->SellingPrice->NetAmount;
                $shred->sel_gross_amount = $item->SellingPrice->GrossAmount;
                $shred->sel_currency_code = $item->SellingPrice->CurrencyCode;
                $shred->ac_amount = $item->ActualBuyingPrice->Amount;
                $shred->ac_currency_code = $item->ActualBuyingPrice->CurrencyCode;
                $shred->client_transaction_id = $item->ClientTransactionID;
                $shred->com_amount = $item->CommunicatedBuyingPrice->Amount;
                $shred->com_currency_code = $item->CommunicatedBuyingPrice->CurrencyCode;

                $shred->save();
            }
        }
    }
    function dataTable()
    {
        $data = [];
        $rowData = GenbaOrderLogsShred::with(['genbaProduct','genbaOrderLog'])->latest()->get();


        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                foreach (json_decode($row->keys) as $item) {
                }

                $data[] = [
                    'id' => $row->id,
                    'productName' => $row->genbaProduct->name,
                    // 'productCode' => $item->Code,
                    'genba_product_id' => $row->genba_product_id,
                    'productSelNet' => $row->sel_net_amount,
                    'productSelGross' => $row->sel_gross_amount,
                    'productSelCurrency' => $row->sel_currency_code,
                    'productAcAmount' => $row->ac_amount,
                    'productAcCurrency' => $row->ac_currency_code,
                    'created' => $row->genbaOrderLog->created_at->toDateTimeString(),
                    'action' => '<a data-id="' . $row->id . '" class="btn details-controls btn-outline-warning btn-sm"><i class="bx bx-down-arrow-alt" style="margin:0;"></i></a>'
                ];
            }
        }
        return $data;
    }
}
