<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\HelperApi;
use App\Services\ServiceService;
use App\Services\CategoryServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;



class ServiceController extends Controller
{
        use HelperApi;
    protected $ServiceService;
    protected $CategoryServices;

    public function __construct(ServiceService $ServiceService,CategoryServices $CategoryServices)
    {
        $this->ServiceService = $ServiceService;
        $this->CategoryServices=$CategoryServices;
    }

    public function getService(Category $category,Request $request){
        $service = $this->ServiceService->getService($category,$request);
        return $this->onSuccess(200, 'Service Success', $service);
    }
    public function storeService(ServiceRequest $serviceRequest){

        $service = $this->ServiceService->storeService($serviceRequest);
        return $this->onSuccess(200, 'Service Success', $service);
    }
}
