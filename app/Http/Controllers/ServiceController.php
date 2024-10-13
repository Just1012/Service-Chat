<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Service;
use App\Models\Category;
use App\Models\FieldType;
use App\Models\ServiceField;
use Illuminate\Http\Request;
use App\Services\FieldsService;
use App\Services\ServiceService;
use App\Services\CategoryServices;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    protected $FieldsService;
    protected $ServiceService;
    protected $CategoryServices;


    public function __construct(ServiceService $ServiceService, CategoryServices $CategoryServices, FieldsService $FieldsService)
    {
        $this->FieldsService = $FieldsService;
        $this->ServiceService = $ServiceService;
        $this->CategoryServices = $CategoryServices;
        $this->middleware(['auth', 'admin']);
    }

    public function index(Category $category)
    {
        return view('dashboard.services.index', ['category' => $category]);
    }

    public function datatable($id)
    {
        $data = Service::where('category_id', $id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'found data'
        ]);
    }

    public function create(Category $category)
    {
        $fields = $this->FieldsService->getField();
        return view('dashboard.services.create', ['type_page' => 'create', 'category' => $category, 'fields' => $fields]);
    }

    public function edit(Service $service)
    {
        $serviceField = $service->serviceFields;

        $fields = $this->FieldsService->getField();
        $categories = $this->CategoryServices->getCategory();
        return view('dashboard.services.create', ['type_page' => '', 'data' => $service, 'category' => $categories, 'fields' => $fields, 'serviceField' => $serviceField]);
    }

    public function store(ServiceRequest $serviceRequest)
    {
        $result = $this->ServiceService->storeService($serviceRequest);
        return redirect()->back();
    }
    public function updateStatus(Service $service)
    {
        $result = $this->ServiceService->updateStatus($service);
        return response()->json([
            'message' => $result,
            'status' => '200'
        ]);
    }

    public function deleteImage(Request $request)
    {
        $image = $request->input('image');
        $serviceId = $request->input('service_id');

        $service = Service::find($serviceId);

        if ($service) {
            $images = json_decode($service->multiImages);
            $images = array_diff($images, [$image]);
            $service->multiImages = json_encode(array_values($images));
            $service->save();

            // Delete the image file from the file system
            $imagePath = public_path('images/' . $image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            return redirect()->back()->with('success', 'Image deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Service not found');
        }
    }
}
