<?php

namespace App\Http\Controllers;

use App\Models\BankDefinition;
use App\Repositories\BankDefinitionRepository;
use Illuminate\Http\Request;

class BankDefinitionController extends Controller
{

    public function __construct(BankDefinitionRepository $bankRepository)
    {
        $this->bankRepo = $bankRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
                'title' => __('bankDefinition.mainTitle'),
            ],
            'dataTable' => [
                'source' => 'BankDefinition',
                'columnsTitles' => [
                    __('bankDefinition.tableId'),
                    __('bankDefinition.title'),
                    __('bankDefinition.accCode'),
                    __('bankDefinition.tableStatus'),
                ],
                'columns' => [
                    'DT_RowIndex',
                    'bank',
                    'accounting_code',
                    'isActive',
                    // 'status'
                ],
                'route' => 'bankDefinitions',
                'delete' => [
                    'titleField' => 'title'
                ],
                'popup' => true,
                'edit' => [
                    'columns' => [
                        'bank',
                        'accounting_code',
                        'isActive',
                    ]
                ]
            ],
        ];
        return view('bankDefinition.index')->with('data', $data);
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
        $result = $this->bankRepo->save($request);

        return redirect()->route('bankDefinitions.index')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banks = BankDefinition::find($id);
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
        $banks = BankDefinition::find($id);
        $banks->delete();
        return redirect()->route('bankDefinitions.index')->with('success', 'Supplier deleted successfully');
    }

    public function saveBank(Request $request) {
        dd($request->all());
    }
}
