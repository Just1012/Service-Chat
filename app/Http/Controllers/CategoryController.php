<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $CategoryServices;

    public function __construct(CategoryServices $CategoryServices)
    {
        $this->CategoryServices = $CategoryServices;
        $this->middleware(['auth','admin']);

    }

    public function index()
    {
        return view('dashboard.categories.index');
    }

    public function datatable()
    {
        $data = Category::all();
        return response()->json([
            'data' => $data,
            'message' => 'found data'
        ]);
    }

    public function create()
    {
        return view('dashboard.categories.create', ['type_page'=>'create']);
    }
    public function edit(Category $category)
    {
        return view('dashboard.categories.create', ['type_page'=>'','data'=>$category]);
    }

    public function store(CategoryRequest $CategoryRequest)
    {
        $result = $this->CategoryServices->storeCategory($CategoryRequest);
        return redirect()->route('category.index') ;
    }

    public function updateStatus(Category $category)
    {
        $result=$this->CategoryServices->updateStatus($category);
        return response()->json([
            'message' => $result,
            'status' => '200'
        ]);
    }
}
