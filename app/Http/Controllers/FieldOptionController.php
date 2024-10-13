<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldOption;
use Illuminate\Http\Request;
use App\Services\FieldsService;
use App\Services\FieldOptionService;
use Brian2694\Toastr\Facades\Toastr;

class FieldOptionController extends Controller
{
    protected $FieldOptionService;
    protected $FieldsService;

    public function __construct(FieldOptionService $FieldOptionService,FieldsService $FieldsService)
    {
        $this->FieldOptionService = $FieldOptionService;
        $this->FieldsService=$FieldsService;
        $this->middleware(['auth','admin']);

    }

    public function index(Field $field)
    {

        return view('dashboard.fieldOption.index',['field'=>$field]);
    }

    public function datatable($id)
    {
        $data = FieldOption::where('field_id',$id)->get();
        return response()->json([
            'data' => $data,
            'message' => 'found data'
        ]);
    }

    public function create(Field $field)
    {
        return view('dashboard.fieldOption.create', ['type_page' => 'create','field'=>$field]);
    }

    public function edit(FieldOption $fieldOption)
    {
      //  $field=$this->FieldsService->getField();
      if($fieldOption->id ==3){
           $successMessage="لا يمكن تعديل هذا لبحقل ";
        toastr()->info($successMessage,  'تنبيه');

          return redirect()->back(); 
      }
        return view('dashboard.fieldOption.create', ['type_page'=>'','data'=>$fieldOption,]);
    }

    public function store(Request $request)
    {
        $result = $this->FieldOptionService->storeFieldOption($request);
        return redirect()->route('field.index');
    }


}
