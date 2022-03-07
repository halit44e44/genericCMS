<?php

namespace App\Repositories;

use App\Models\AccountActivities;
use App\Models\Companies\Company;
use Orkhanahmadov\EloquentRepository\EloquentRepository;

class AccountActivitiesRepository extends EloquentRepository
{
    protected $entity = AccountActivities::class;
    
    public function save($request){
        $data = ['error', 'error'];
  
          if ($request->get('id')) {
  
              $accActivities = AccountActivities::where('id', $request->get('id'))->first();
              $action = 'updated';
          } else {
            $accActivities = new AccountActivities();
              $action = 'created';
          }
          $companyAmount = Company::where('id', $request->get('company_id'))->first();

          $accActivities->company_id = $request->get('company_id');
          $accActivities->bank_id = $request->get('bank_id');
          $accActivities->amount = $request->get('amount');
          $accActivities->old_balance = $companyAmount->ballance;
          $accActivities->description = $request->get('description');
          $accActivities->save();

          $companyAmount = Company::where('id', $request->get('company_id'))->first();
          $companyAmount->ballance += $request->get('amount');
          $companyAmount->save();

          
          

  
  
          if ($accActivities) {
              $data = ['success' => 'Account Activity ' . $action . ' successfully.'];
          }
  
          return $data;
      }
  
    function dataTable()
    {
        $data = [];
        $rowData = AccountActivities::with(['companies','bank'])->orderBy('created_at','desc')->get();
        
        if (count($rowData) > 0) {
            foreach ($rowData as $row) {
                $data[] = [
                    'id' => $row->id,
                    'company_id' => $row->companies->title,
                    'bank_id' => $row->bank->bank,
                    'amount' => $row->amount,
                    'old_balance' => $row->old_balance,
                    'ballance' => $row->companies->ballance,
                    'description' => $row->description,
                    'created_at' => $row->created_at->toDateTimeString(),
                    'action' => ''
                ];
            }
        }
        return $data;
}
}