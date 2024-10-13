<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldType;
use Illuminate\Http\Request;
use App\Services\FieldsService;

class FieldsController extends Controller
{
    protected $FieldsService;
    public function __construct(FieldsService $FieldsService)
    {
        $this->FieldsService = $FieldsService;
        $this->middleware(['auth','admin']);

    }

    public function index()
    {
        return view('dashboard.fields.index');
    }

    public function datatable()
    {
        $ids = [6, 7, 8];
        $data = Field::whereNotIn('id', $ids)->get();
       
        return response()->json([
            'data' => $data,
            'message' => 'found data'
        ]);
    }

    public function create()
    {
        $fieldType = FieldType::all();
        return view('dashboard.fields.create', ['type_page'=>'create','fieldType'=> $fieldType]);
    }
    public function edit(Field $field)
    {
        if($field->id ==6 || $field->id ==7 ||$field->id ==8){
            return redirect()->back();
        }
        $fieldType = FieldType::all();
        return view('dashboard.fields.create', ['type_page'=>'','data'=>$field,'fieldType'=> $fieldType]);
    }

    public function store(Request $request)
    {
       // $field = Field::all();
        $result = $this->FieldsService->storeField($request);

        if ($request->type == 4) {
            return view('dashboard.fieldOption.create', ['type_page'=>'create','field'=> $result[1]]);
        }else{
            return redirect()->route('field.index');
        }
    }

    public function updateStatus(Field $field)
    {
        $result=$this->FieldsService->updateStatus($field);
        return response()->json([
            'message' => $result,
            'status' => '200'
        ]);
    }
}
