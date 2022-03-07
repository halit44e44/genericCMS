<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlatformRequest;
use App\Models\Platform;
use App\Repositories\PlatformRepository;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function __construct(PlatformRepository $platformRepository)
   {
       $this->platformRepo = $platformRepository;
   }
    
    public function index()
    {
        $data = [
            'breadcrumb' => [
              'title' => __('platform.mainTitle'),
            ],
            'dataTable' => [
              'source' => 'platform',
              'columnsTitles' => [
                __('supplier.tableId'),
                __('supplier.tableName'),
            
              ],
              'columns' => [
                'DT_RowIndex',
                'name'
                
              ],
              'route' => 'platforms',
              'delete' => [
                'titleField' => 'name'
              ],
              'popup' => true,
              'edit' => [
                'columns' => [
                  'id',
                  'name',
                
                ]
              ]
            ],
        ];

        return view('platforms.index')->with('data', $data);
    }

  
    public function create()
    {
        //
    }


    public function store(PlatformRequest $request)
    {
        $result=$this->platformRepo->save($request); 

      return redirect()->route('platforms.index')
        ->with($result);  
    }

    
    public function show($id)
    {
        $platforms = Platform::find($id);
        return response()->json($platforms);
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
        $platforms = Platform::find($id);
        $platforms->delete();
        return redirect()->route('platforms.index')->with('success', 'Platform deleted successfully');
    }
}
