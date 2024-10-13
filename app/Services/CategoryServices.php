<?php

namespace App\Services;

use Exception;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;

class CategoryServices
{
    public function storeCategory($request)
    {
        try {
            $requestData = $request->all();


            $oldImage = Category::find($requestData['id'] ?? null)->image ?? null;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('images'), $imageName);
                $requestData['image'] = $imageName;

                if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                    unlink(public_path('images/' . $oldImage));
                }
            }

            Category::updateOrCreate(
                ['id' => $requestData['id'] ?? null],
                $requestData
            );

            $successMessage = $requestData['id'] ? 'تم تعديل الفئة بنجاح' : 'تم إضافة الفئة بنجاح';
            toastr()->success($successMessage, 'تم بنجاح');

            return $successMessage;
        } catch (\Throwable $th) {
            toastr()->error('أعد المحاولة', 'خطاء');
            return 'أعد المحاولة';
        }
    }


    public function getCategory()
    {
        $data = Category::where('status', 0)->get();
        return $data;
    }

    public function updateStatus($category)
    {
        try {
            $category->update([
                'status' => $category->status == 0 ? 1 : 0
            ]);

            $successMessage = $category->status == 1 ?
                'تم تفعيل الفئة بنجاح' :
                'تم إلغاء تفعيل الفئة بنجاح';

            return $successMessage;
        } catch (\Throwable $th) {
            return response()->json(['status' => '404']);
        }
    }
}
