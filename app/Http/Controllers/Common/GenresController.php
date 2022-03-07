<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenresRequest;
use App\Models\Genres;
use App\Repositories\GenresRepository;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function __construct(GenresRepository $genresRepository)
    {
        $this->genresRepo = $genresRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
              'title' => __('genres.mainTitle'),
            ],
            'dataTable' => [
              'source' => 'genres',
              'columnsTitles' => [
                __('genres.tableId'),
                __('genres.tableName'),
                
              ],
              'columns' => [
                'DT_RowIndex',
                'name',
                
              ],
              'route' => 'genres',
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
        return view('genres.index')->with('data', $data);
    }

    public function create()
    {
        //
    }

    public function store(GenresRequest $request)
    {
        $result = $this->genresRepo->save($request);
        return redirect()->route('genres.index')
        ->with($result); 
    }

    public function show($id)
    {
        $genres = Genres::find($id);
        return response()->json($genres);
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
        $genres = Genres::find($id);
        $genres->delete();
        return redirect()->route('genres.index')->with('success', 'Genres deleted successfully');
    }
}
