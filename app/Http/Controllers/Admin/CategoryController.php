<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\Category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $categories = Category::orderBy('id', 'desc')->paginate(50);
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->only(['categories']));
        return view('admin.categories._list', ['categories' => Category::orderBy('id', 'desc')->paginate(50)])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $categories, CategoryRequest $request)
    {
        $this->authorize('update', $categories);
        $category = Category::findOrFail($request->id);
        $update = $category->update($request->only(['categories']));
        $true = response()->json(['true' => 'Successfully!']);
        $false = response()->json(['false' => 'Something went wrong!']);
        return $update ? $true : $false;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $this->authorize('delete', $category);
        $delete = Category::whereIn('id', $request->input('id'))->delete();
        $true = response()->json(['true' => 'Successfully!']);
        $false = response()->json(['false' => 'Something went wrong!']);
        return $delete ? $true : $false;
    }



    /**
     * Search data in the table
     * @param \Illuminate\Http\Request  $request
     * @return $categories the data found
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $categories = Category::where('categories', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')->paginate(50);
        return view('admin.categories._list', compact('categories'))->render();

    }




    /**
     *
     * Fetch data in the table
     * @param  \Illuminate\Http\Request  $request
     * @return $categories
     */
    public function fetch_data(Request $request)
    {
        $view = $request->view;
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $categories = Category::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view($view, ['categories' => $categories])->render();

    }
}
