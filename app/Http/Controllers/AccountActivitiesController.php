<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountActivitiesRequest;
use App\Models\AccountActivities;
use App\Models\BankDefinition;
use App\Models\Companies\Company;
use App\Repositories\AccountActivitiesRepository;
use Illuminate\Http\Request;

class AccountActivitiesController extends Controller
{
    public function __construct(AccountActivitiesRepository $accountActivitiesRepository)
    {
        $this->accountActivitiesRepo = $accountActivitiesRepository;
    }
    public function index()
    {
      $companies = Company::get();
      $banks = BankDefinition::get();
        $data = [
            'breadcrumb' => [
              'title' => __('accountActivities.mainTitle'),
            ],
            'dataTable' => [
              'source' => 'accountActivities',
              'columnsTitles' => [
                __('accountActivities.no'),
                __('accountActivities.tableId'),
                __('accountActivities.company'),
                __('accountActivities.bank'),
                __('accountActivities.amount'),
                __('accountActivities.old_balance'),
                __('accountActivities.ballance'),
                __('accountActivities.description'),
                __('accountActivities.created'),

              ],
              'columns' => [
                'DT_RowIndex',
                'id',
                'company_id',
                'bank_id',
                'amount',
                'old_balance',
                'ballance',
                'description',
                'created_at',

              ],
              'route' => 'accountActivities',
              'delete' => [
                'titleField' => ''
              ],
              'popup' => true,
              'edit' => [
                'columns' => [
                  'id',
                  
                ]
              ]
            ],
     
          ];
      
          return view('accountActivities.index')->with('data', $data)->with('companies',$companies)->with('banks',$banks);
    }

    public function store(AccountActivitiesRequest $request)
    {
      $result = $this->accountActivitiesRepo->save($request);

      return redirect()->route('accountActivities.index')->with($result);
    }
}
