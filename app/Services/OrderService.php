<?php

namespace App\Services;

use Exception;
use App\Models\Field;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderForm;
use App\Models\ServiceField;
use App\Models\User;
use PayMob\Facades\PayMob;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AccountActivated;
use App\Notifications\CustomNotification;
use App\Models\FieldOption;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;





class OrderService
{
    public function getOrder_id($request)
    {
         $user = User::where('id', '=', auth()->id())->first();
        $order = Order::with('services')
            ->where($user->role_id == 1 ? 'user_id' : 'send_to', '=', auth()->id())
              ->when($request->filled('type'), function ($query) use ($request) {
            $query->whereHas('services', function ($query) use ($request) {
                $query->where('type', '=', $request->type);
            });
        })
            ->orderByDesc('created_at')
            ->get();

        return $order;
    }


    public function getOrder($order)
    {
        $order = Order::with('orderForm.field', 'services.serviceFields.field.fieldOptions')->find($order->id);
        $a7aa = $order->services->serviceFields->merge($order->orderForm->whereIn('field_id', [6, 7, 8]));
        $a7aa = $a7aa->unique(function ($item) {
            return $item->field_id ?? null;
        });

        $formattedData = $a7aa->map(function ($field) use ($order) {
            $fieldData = $field;
            if (isset($field->field_id)) {
                $fieldData['field']['value'] = $order->orderForm->where('field_id', $field->field_id)->pluck('value')->first();
            } else {
                $fieldData['field']['value'] = null;
            }

            return  $fieldData;
        });

        $services = $order->services;
        $services->multiImages = json_decode($services->multiImages);
        $services['total'] = number_format($services->price - $services->discount, 2);

        // // Convert the services to an array if it's not already
        if ($services instanceof \Illuminate\Database\Eloquent\Collection) {
            $services = $services->toArray();
        } elseif ($services instanceof \App\Models\Service) {
            $services = $services->toArray();
        }

        $services['service_fields'] = $formattedData;

        // Reindex 'service_fields' if it's a collection
        if ($services['service_fields'] instanceof \Illuminate\Support\Collection) {
            $services['service_fields'] = $services['service_fields']->values();
        } else if (is_array($services['service_fields'])) {
            // If it's an array, use array_values to reset the keys
            $services['service_fields'] = array_values($services['service_fields']);
        }

        return $services;
    }


    public function storeOrder($request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'services_id' => $request->service_id
        ]);
        $payway = 'Cash';

        $user = User::find($order->user_id);
        // $user->notify(new CustomNotification("تم انشاء الطلب" ,  'الطلب قيد الانتظار'));
        $notification = Notification::create([
            'title'         => 'تم إنشاء الطلب ',
            'description'   => 'الطلب قيد الانتظار',
            'user_id'       => auth()->id(),
        ]);


        $formData = $request->input('form'); // Decode JSON data

        //  $ar = json_decode($formData, true);



        foreach ($formData as $data) {
            if (isset($data['field_id']) && $data['field_id'] == 10) {

                $fieldOption = FieldOption::find($data['value']);
                if ($fieldOption) {
                    $payway = $fieldOption->option_en;
                }
            }
            OrderForm::create([
                'order_id' => $order->id,
                'field_id' => $data['field_id'],
                'value' => $data['value'],
            ]);
        }
        $total = $order->services->price - $order->services->discount;
        $order->price =  $order->services->price;
        $order->discount = $order->services->discount;
        $order->total  = $total;
        OrderForm::create([
            'order_id' => $order->id,
            'field_id' => 6,
            'value' => $order->price,
        ]);
        OrderForm::create([
            'order_id' => $order->id,
            'field_id' => 7,
            'value' => $order->discount,
        ]);
        OrderForm::create([
            'order_id' => $order->id,
            'field_id' => 8,
            'value' => $total,
        ]);
        $order->save();
        $amount = $total;




        if ($payway == 'Cash') {
        } else {

            return $this->pay($amount, $order->id);
        }
    }

    public function pay(float $amount, int $order_id)
    {
        // Perform authentication request
        $authResponse = PayMob::AuthenticationRequest();

        // Check if authentication was successful and 'token' property exists
        if (isset($authResponse->token)) {
            // Make order registration request
            $order = PayMob::OrderRegistrationAPI([
                'auth_token' => $authResponse->token,
                'amount_cents' => $amount * 100,
                'currency' => 'EGP',
                'delivery_needed' => false,
                'merchant_order_id' => $order_id,
                'items' => []
            ]);

            // Make payment key request
            $paymentKeyResponse = PayMob::PaymentKeyRequest([
                'auth_token' => $authResponse->token,
                'amount_cents' => $amount * 100,
                'currency' => 'EGP',
                'order_id' => $order->id,
                "billing_data" => [
                    "apartment" => "803",
                    "email" => "claudette09@exa.com",
                    "floor" => "42",
                    "first_name" => "Clifford",
                    "street" => "Ethan Land",
                    "building" => "8028",
                    "phone_number" => "+201067346623",
                    "shipping_method" => "PKG",
                    "postal_code" => "01898",
                    "city" => "Jaskolskiburgh",
                    "country" => "CR",
                    "last_name" => "Nicolas",
                    "state" => "Utah"
                ]
            ]);


            $redirectUrl = "https://soitmed.onclick-eg.com/payments/verify/{$paymentKeyResponse->token}";

            // Redirect the user to PayMob payment page
            return redirect()->away($redirectUrl);
        } else {
            // Handle case where authentication failed or response format is incorrect
            // For example, log an error or return a response indicating authentication failure
            // Example: return response()->json(['error' => 'Authentication failed'], 500);
        }
    }

    public function updateOrderStatus($order)
    {
        try {
            $order->update([
                'status' => $order->status == 0 ? 1 : 0
            ]);




            $successMessage = $order->status == 1 ?
                'تم تفعيل الطلب بنجاح' :
                'تم إلغاء تفعيل الطلب بنجاح';

            return $successMessage;
        } catch (\Throwable $th) {
            return response()->json(['status' => '404']);
        }
    }
}
