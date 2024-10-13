<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SliderService;

use Illuminate\Http\Request;
use App\Http\Traits\HelperApi;
use App\Models\Service;
use App\Models\ServiceField;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    use HelperApi;
    protected $sliderService;
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }
    public function getSlider()
    {
        $slider = $this->sliderService->getSlider();
        return $this->onSuccess(200, 'Ads Success', $slider);
    }
    
}
