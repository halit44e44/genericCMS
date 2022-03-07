<?php

namespace App\Repositories;

use App\Models\BankDefinition;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class BankDefinitionRepository extends EloquentRepository
{
    protected $entity = BankDefinition::class;

    function save($request) {

        $data = ['error', 'error'];

        if ($request->get('id')) {
            $bank = BankDefinition::where('id', $request->get('id'))->first();
            $action = 'updated';
        } else {
            // dd($request);
            $bank = new BankDefinition();
            $action = 'created';
        }

        $bank->bank = $request->get('bank');
        $bank->accounting_code = $request->get('accounting_code');
        $bank->isActive = $request->boolean('isActive');
        $bank->save();

        if ($bank) {
            $data = ['success' => 'Category ' . $action . ' successfully.'];
        }
    }

    function dataTable()
    {
        $data = [];
        $rowData = BankDefinition::latest()->get();
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'bank' => $row->bank,
                    'accounting_code' => $row->accounting_code,
                    // 'imgUrl'=>$row->imgUrl,
                    'isActive'=>$row->isActive,
                    // 'status'=>$row->status,
                    'action' => '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn edit btn-outline-warning btn-sm">Edit</a>
                                <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn delete btn-outline-danger btn-sm">Delete</a>'
                ];
            }
        }
        return $data;
    }
}
