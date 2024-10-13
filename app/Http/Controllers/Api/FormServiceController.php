<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\ServiceField;
use App\Http\Traits\HelperApi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FormServiceController extends Controller
{
    use HelperApi;
    public function serviceForm(Service $service)
    {
        $serviceForm = Service::with('serviceFields.field.fieldOptions')->where('id', $service->id)->first();
        $serviceForm->multiImages = json_decode($serviceForm->multiImages);
            $serviceForm['total'] = number_format($serviceForm->price - $serviceForm->discount, 2);
        
        
        foreach($serviceForm as $new){
        }
        return $this->onSuccess(200, 'Service Form Success', $serviceForm);

        // $data = DB::table('services')
        //     ->join('service_fields', 'services.id', '=', 'service_fields.services_id')
        //     ->join('fields', 'service_fields.field_id', '=', 'fields.id')
        //     ->leftJoin('field_options', 'fields.id', '=', 'field_options.field_id')
        //     ->select([
        //         'fields.id as fields_id',
        //         'fields.name as fields_name',
        //         'fields.type as fields_type',
        //         'fields.type_validation as fields_type_validation',
        //         DB::raw('CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT(\'id\', field_options.id, \'option\', field_options.option, \'created_at\', field_options.created_at, \'updated_at\', field_options.updated_at)), \']\') as options')
        //     ])
        //     ->groupBy('fields_id', 'fields_name', 'fields_type', 'fields_type_validation')
        //     ->get();

        // foreach ($data as $item) {
        //     $item->options = json_decode($item->options);
        // }

    }
}
