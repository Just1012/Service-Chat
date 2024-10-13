<?php

namespace App\Services;

use Exception;
use App\Models\Field;
use Brian2694\Toastr\Facades\Toastr;

class FieldsService
{
    public function storeField($request)
{
    try {
        

        $requestData = $request->all();
        $oldImage = Field::find($requestData['id'] ?? null)->image ?? null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $requestData['image'] = $imageName;

            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }
        }
if (isset($requestData['id']) && ($requestData['id'] == 6 || $requestData['id'] == 7 || $requestData['id'] == 8)) {
         toastr()->error('أعد المحاولة', 'خطاء');
        return 'أعد المحاولة';
}else{
    
    $data=    Field::updateOrCreate(
            ['id' => $requestData['id'] ?? null],
            $requestData
        );

        $successMessage = $requestData['id'] ? 'تم تعديل الحقل بنجاح' : 'تم إضافة الحقل بنجاح';
        toastr()->success($successMessage, 'تم بنجاح');

        return [$successMessage,$data];
    
}


    } catch (\Throwable $th) {
        toastr()->error('أعد المحاولة', 'خطاء');
        return 'أعد المحاولة';
    }
}


    public function getField()
    {
        $ids = [6, 7, 8];
        $data = Field::WhereNotIn('id', $ids)->get();
        
        return $data;
    }

    public function updateStatus($field)
    {
        try {
            $field->update([
                'status' => $field->status == 0 ? 1 : 0
            ]);

            $successMessage = $field->status == 1 ?
             'تم تفعيل الحقل بنجاح':
             'تم إلغاء تفعيل الحقل بنجاح';

            return $successMessage;
        } catch (\Throwable $th) {
            return response()->json(['status' => '404']);
        }
    }
}
