<?php

namespace App\Services;

use Exception;
use App\Models\FieldOption;
use Brian2694\Toastr\Facades\Toastr;

class FieldOptionService
{
    public function storeFieldOption($request)
{
    try {

        $requestData = $request->all();
        $oldImage = FieldOption::find($requestData['id'] ?? null)->image ?? null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $requestData['image'] = $imageName;
            if ($oldImage && file_exists(public_path('images/' . $oldImage))){
                unlink(public_path('images/' . $oldImage));
            }
        }
        if ($requestData['id'] != null) {
            unset($requestData['field_id']);
        }
        
        
        if (isset($requestData['id']) && ($requestData['id'] == 3 )) {
         toastr()->error('لا يمكن تعديل هذا الحقل', 'خطاء');
        return 'أعد المحاولة';
}else{
        
        
        FieldOption::updateOrCreate(
            ['id' => $requestData['id'] ?? null],
            $requestData
        );

        $successMessage = $requestData['id'] ? 'تم تعديل الاختيارات بنجاح' : 'تم إضافة الاختيارات بنجاح';
        toastr()->success($successMessage, 'تم بنجاح');

        return $successMessage;
}
    } catch (\Throwable $th) {
        toastr()->error('أعد المحاولة', 'خطاء');
        return 'أعد المحاولة';
    }
}


    public function getFieldOption()
    {
        $data = FieldOption::all();
        return $data;
    }
}
