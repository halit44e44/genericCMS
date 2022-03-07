<?php

namespace App\Repositories;

use App\Models\BankAccounts;
use App\Models\BankDefinition;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class BankAccountsRepository extends EloquentRepository
{
    protected $entity = BankAccounts::class;

    public static function save($request) {

        if ($request->get('id')) {
            $bankAccount = BankAccounts::where('id', $request->get('id'))->first();
            $bankAccount->bank_id = $request->get('bank_id_temp');
            $action = 'updated';
        } else {
            $bankAccount = new BankAccounts();
            $bankAccount->bank_id = $request->get('bank_id');
            $action = 'created';
        }
        
        $bankAccount->branch_code = $request->get('branch_code');
        $bankAccount->account_code = $request->get('account_code');
        $bankAccount->iban_no = $request->get('iban_no');
        $bankAccount->account_owner = $request->get('account_owner');
        $bankAccount->isActive = $request->boolean('isActive');
        $bankAccount->description = $request->get('description');
        $bankAccount->save();

        if ($bankAccount) {
            $data = ['success' => 'Bank Account ' . $action . ' successfully.'];
        }
        return $data;
    }

    function getBankData()  {
        $item= BankDefinition::latest()->get();
        return $item;
    }

    function getBankInfo($id) {
        $data = BankDefinition::select('name','surname')->where('id', 1)->get();
    }

    function dataTable()
    {
        $data = [];
        $rowData = BankAccounts::with(['bankDefinition'])->latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'bank_id' => $row->bankDefinition->bank,
                    'branch_code' => $row->branch_code,
                    'account_code' => $row->account_code,
                    'iban_no' => $row->iban_no,
                    'account_owner' => $row->account_owner,
                    'isActive' => $row->isActive,
                    // 'status' => $row->status,
                    // 'imgUrl'=>$row->imgUrl,
                    'description'=>$row->description,
                    // // 'status'=>$row->status,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm">Edit</a>
                                 <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn delete btn-outline-danger btn-sm">Delete</a>'
                ];
            }
        }
        return $data;
    }
}