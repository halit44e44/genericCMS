<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Companies\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepo = $companyRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
                'title' => __('company.mainTitle'),
            ],
            'dataTable' => [
                'source' => 'company',
                'columnsTitles' => [
                    __('company.tableId'),
                    __('company.tableTitle'),
                    __('company.tableDescription'),
                    __('company.tableEmail'),
                    __('company.tableBallance'),
                    // __('company.tableStatus'),
                ],
                'columns' => [
                    'DT_RowIndex',
                    'title',
                    'description',
                    'email',
                    'ballance',
                    // 'status',
                ],
                'route' => 'companies',
                'delete' => [
                    'titleField' => 'title'
                ],
                'popup' => true,
                'edit' => [
                    'columns' => [
                        'id',
                        'title',
                        'description',
                        'email',
                        // 'status',
                    ]
                ]
            ],

        ];
        return view('companies.index')->with('data', $data);
    }

    public function create()
    {
        //
    }

    public function store(CompanyRequest $request)
    {
        $result = $this->companyRepo->save($request);

        return redirect()->route('companies.index')->with($result);
    }

    public function show($id)
    {
        $companies = Company::where('id',$id)->with(['companyApi','companyIp'])->first();
        return response()->json($companies);
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
        $companies = Company::where('id',$id)->first();
        $companies->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
}
