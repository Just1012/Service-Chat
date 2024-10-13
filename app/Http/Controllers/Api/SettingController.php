<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Traits\HelperApi;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Term;

class SettingController extends Controller
{
    use HelperApi;
    protected $SettingService;
    public function __construct(SettingService $SettingService)
    {
        $this->SettingService = $SettingService;
    }

    public function getSetting()
    {
        // $settings = $this->SettingService->getSetting();
        $settings = Setting::first();
        return $this->onSuccess(200, 'Settings Success', $settings);
    }

    public function getTerms(){
        $data = Term::all();
        return response()->json([
            'message' => $data,
            'status' => '200'
        ]);
    }
}
