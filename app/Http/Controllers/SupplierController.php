<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

  public function __construct(SupplierRepository $supplierRepository)
  {
    $this->supplierRepo = $supplierRepository;
  }

  public function index() 
  {
    $data = [
      'breadcrumb' => [
        'title' => __('supplier.mainTitle'),
      ],
      'dataTable' => [
        'source' => 'supplier',
        'columnsTitles' => [
          __('supplier.tableId'),
          __('supplier.tableTitle'),
          __('supplier.tableDescription'),
        ],
        'columns' => [
          'DT_RowIndex',
          'title',
          'description'
        ],
        'route' => 'suppliers',
        'delete' => [
          'titleField' => 'title'
        ],
        'popup' => true,
        'edit' => [
          'columns' => [
            'id',
            'title',
            'description',
          ]
        ]
      ],

    ];

    return view('suppliers.index')->with('data', $data);
  }

  public function create()
  {
    //
  }

  public function store(SupplierRequest $request)
  {
    $result = $this->supplierRepo->save($request);

    return redirect()->route('suppliers.index')
      ->with($result);
  }

  public function show($id)
  {
    $suppliers = Supplier::find($id);
    return response()->json($suppliers);
  }


  public function edit($id)
  {
    //
  }

  public function update(Request $request, Supplier $suppliers)
  {
    //
  }

  public function destroy($id)
  {
    $suppliers = Supplier::find($id);
    $suppliers->delete();
    return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
  }
}
