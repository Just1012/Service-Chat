<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\Validation\Validator;

use App\Models\Category;
use App\Services\CategoryServices;
use App\Http\Traits\HelperApi;
class CategoryController extends Controller
{
     use HelperApi;
    protected $CategoryService;

    public function __construct(CategoryServices $CategoryService)
    {
        $this->CategoryService = $CategoryService;

    }

    public function storeCategory(CategoryRequest $categoryRequest){
        $validator = \Illuminate\Support\Facades\Validator::make($categoryRequest->all(), $categoryRequest->rules(), $categoryRequest->messages());

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
        $category = $this->CategoryService->storeCategory($categoryRequest);
        return $this->onSuccess(200,$category,$category);
    }

    public function updateCategory(Category $category){
        return response($category,200);
    }


    public function getCategory(){

        $category = $this->CategoryService->getCategory();
        return $this->onSuccess(200, 'Category Success', $category);
    }
    public function getCategoryServices(){
    $data = Category::with('services')->get();
    foreach ($data as $category) {
        foreach ($category->services as $service) {
            $service['multiImages'] = json_decode($service->multiImages);
            $service['total'] = number_format($service->price - $service->discount, 2);
        }
    }
     return $this->onSuccess(200, 'Category with services', $data);
   }

    public function updateStatus(Category $category){
        $category = $this->CategoryService->updateStatus($category);
        return response("Status Updated Successfully",200);
    }

}
