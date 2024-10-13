<?php

namespace App\Services;

use Exception;
use App\Models\Slider;
use Brian2694\Toastr\Facades\Toastr;

class SliderService
{
    public function getSlider()
    {
        $data = Slider::where('status',0)->get();
        return $data;
    }

    public function storeSlider($request)
    {

            $requestData = $request->all();
            $oldImage = Slider::find($requestData['id'] ?? null)->image ?? null;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $requestData['image'] = $imageName;

                if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                    unlink(public_path('images/' . $oldImage));
                }
            }

            if($requestData['type'] == '1') {
                $requestData['type_id']= $requestData['type_category'];

            }
            elseif($requestData['type'] == '2') {
                $requestData['type_id']= $requestData['type_services'];


            }
            elseif($requestData['type'] == '3') {
                $requestData['type_id']= $requestData['type_text'];
            }
            unset($requestData['type_services']);
            unset($requestData['type_category']);
            unset($requestData['type_text']);
            Slider::updateOrCreate(
                ['id' => $requestData['id'] ?? null],
                $requestData
            );
            $successMessage = $requestData['id'] ? 'تم تعديل الاعلان بنجاح' : 'تم إضافة الاعلان بنجاح';
            toastr()->success($successMessage, 'تم بنجاح');

            return $successMessage;

    }

    public function updateStatus($slider)
    {
        try {
            $slider->update([
                'status' => $slider->status == 0 ? 1 : 0
            ]);

            $successMessage = $slider->status == 1 ?
                'تم تفعيل الاعلان بنجاح' :
                'تم إلغاء تفعيل الاعلان بنجاح';

            return $successMessage;
        } catch (\Throwable $th) {
            return response()->json(['status' => '404']);
        }
    }



}
