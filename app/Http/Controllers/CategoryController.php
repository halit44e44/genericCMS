<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function index()
    {
        $data = [
            'breadcrumb' => [
                'title' => __('category.mainTitle'),
            ],
            'dataTable' => [
                'source' => 'category',
                'columnsTitles' => [
                    __('category.tableId'),
                    __('category.tableTitle'),
                    __('category.tableDescription'),
                    // __('category.tableImgUrl'),
                    __('category.tableParent_id'),
                    // __('category.tableStatus'),

                ],
                'columns' => [
                    'DT_RowIndex',
                    'title',
                    'description',
                    // 'imgUrl',
                    'parent_id',
                    // 'status'
                ],
                'route' => 'categories',
                'delete' => [
                    'titleField' => 'title'
                ],
                'popup' => true,
                'edit' => [
                    'columns' => [
                        'id',
                        'title',
                        'description',
                        // 'imgUrl',
                        'parent_id',
                        // 'status'
                    ]
                ]
            ],

        ];

        return view('categories.index')->with('data', $data);
    }


    public function create()
    {
        return view('categories.createOrUpdate');
    }

    public function store(CategoryRequest $request)
    {
        if (isset($_POST["btnSubmit"])) {
            $result = $this->categoryRepo->save($request);
            return redirect()->route('categories.index')
                ->with($result);
        }

        $category = Category::where('id', $request->id)->first();

        return view('categories.createOrUpdate')->with('category', $category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);

    }

    public function edit(Request $request)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
