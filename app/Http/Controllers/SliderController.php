<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\SliderService;
use App\Http\Requests\SliderRequest;
use App\Models\Service;

class SliderController extends Controller
{
    protected $SliderService;

    public function __construct(SliderService $SliderService)
    {
        $this->SliderService = $SliderService;
        $this->middleware(['auth','admin']);

    }

    public function index()
    {
        return view('dashboard.slider.index');
    }

    public function datatable()
    {
        $data = Slider::all();
        return response()->json([
            'data' => $data,
            'message' => 'found data'
        ]);
    }

    public function create()
    {
        $category = Category::all();
        $service = Service::with('category')->get();
        $uniqueCategories = $service->unique('category_id');
        return view('dashboard.slider.create', ['type_page'=>'create','category'=>$category,'service'=>$service,'uniqueCategories'=>$uniqueCategories]);
    }
    public function edit(Slider $slider)
    {
        $category = Category::all();
        $service = Service::with('category')->get();
        $uniqueCategories = $service->unique('category_id');
        return view('dashboard.slider.create', ['type_page'=>'','data'=>$slider,'category'=>$category,'service'=>$service,'uniqueCategories'=>$uniqueCategories]);
    }

    public function store(SliderRequest $SliderRequest)
    {
        $result = $this->SliderService->storeSlider($SliderRequest);
        return redirect()->route('slider.index');
    }

    public function updateStatus(Slider $slider)
    {
        $result=$this->SliderService->updateStatus($slider);
        return response()->json([
            'message' => $result,
            'status' => '200'
        ]);
    }
}
