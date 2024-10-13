<?php

namespace App\Services;

use Exception;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;

class SettingService
{
    public function storeSetting($request)
    {
        try {
            $requestData = $request->all();
            $oldImage = Setting::find($requestData['id'] ?? null)->image ?? null;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $requestData['image'] = $imageName;

                if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                    unlink(public_path('images/' . $oldImage));
                }
            }

            Setting::updateOrCreate(
                ['id' => $requestData['id'] ?? null],
                $requestData
            );

            $successMessage = $requestData['id'] ? 'تم تعديل الهاتف بنجاح' : 'تم إضافة الهاتف بنجاح';
            toastr()->success($successMessage, 'تم بنجاح');

            return $successMessage;
        } catch (\Throwable $th) {
            toastr()->error('أعد المحاولة', 'خطاء');
            return 'أعد المحاولة';
        }
    }

    public function getSetting()
    {
        $data = Setting::all();
        return $data;
    }


}
