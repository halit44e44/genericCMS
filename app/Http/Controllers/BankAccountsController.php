<?php

namespace App\Http\Controllers;

use App\Models\BankAccounts;
use App\Repositories\BankAccountsRepository;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{

    public function __construct(BankAccountsRepository $bankAccountRepository)
    {
        $this->bankAccountRepo = $bankAccountRepository;
    }

    public function index()
    {
        $banks= $this->bankAccountRepo->getBankData();
        $data = [
            'banks'=>$banks,
            'breadcrumb' => [
                'title' => __('bankAccounts.mainTitle'),
            ],
            'dataTable' => [
                'source' => 'bankAccounts',
                'columnsTitles' => [
                    '#',
                    __('bankAccounts.title'),
                    __('bankAccounts.branchName'),
                    __('bankAccounts.account_number'),
                    __('bankAccounts.iban'),
                    // __('bankAccounts.accountOwner'),
                    __('bankAccounts.tableStatus'),
                    // __('bankAccounts.description'),
                ],
                'columns' => [
                    'DT_RowIndex',
                    'bank_id',
                    'branch_code',
                    'account_code',
                    'iban_no',
                    // 'account_owner',
                    'isActive',
                    // 'status',
                    // 'description',
                ],
                'route' => 'bankAccounts',
                'delete' => [
                    'titleField' => 'branch_code'
                ],
                'popup' => true,
                'edit' => [
                    'columns' => [
                        'bank_id',
                        'branch_code',
                        'account_code',
                        'iban_no',
                        'account_owner',
                        'isActive',
                        'description',
                    ]   
                ]
            ],
        ];
        
        return view('bankAccounts.index')->with(['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->bankAccountRepo->save($request);
        return redirect()->route('bankAccounts.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banks = BankAccounts::find($id);
        return response()->json($banks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banks = BankAccounts::find($id);
        $banks->delete();
        return redirect()->route('bankAccounts.index')->with('success', 'Bank Account deleted successfully');
    }
}
