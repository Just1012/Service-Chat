<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderForm;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Traits\HelperApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderFormRequest;
use App\Models\Field;
use App\Http\Helpers\Hashing;
use App\Http\Helpers\VerifySignature;
use App\Models\Service;
use App\Models\ServiceField;
use App\Models\User;
use PayMob\Facades\PayMob;
use App\Notifications\CustomNotification;
use App\Models\FieldOption;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;


class OrderController extends Controller
{
    use HelperApi;

    protected $OrderService;
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }


    //////////////////////////////////////////
    public function  get_order_user(Request $request)
    {
        $order = $this->OrderService->getOrder_id($request);
        return $this->onSuccess(200, 'Orders for user Success', $order);
    }

    public function getOrder(Order $order)
    {

        $order = $this->OrderService->getOrder($order);
        return $this->onSuccess(200, 'Order Success', $order);
    }
    
    //     public function storeOrderForm(Request $OrderFormRequest){
    //     $request = $OrderFormRequest;
    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'services_id' => $request->service_id
    //     ]);
    //     $payway = 'Cash';

    //     $user = User::find($order->user_id);
    //     // $user->notify(new CustomNotification("تم انشاء الطلب" ,  'الطلب قيد الانتظار'));
    //     $notification = Notification::create([
    //         'title'         => 'تم إنشاء الطلب ',
    //         'description'   => 'الطلب قيد الانتظار',
    //         'user_id'       => auth()->id(),
    //     ]);

    //     $formData = $request->input('form'); // Get form data

    //     // Check if $formData is a valid JSON string
    //     if ($formData && is_string($formData) && is_array(json_decode($formData, true))) {
    //         $ar = json_decode($formData, true);

    //         foreach ($ar as $data) {
    //             if (isset($data['field_id']) && $data['field_id'] == 10) {
    //                 $fieldOption = FieldOption::find($data['value']);
    //                 if ($fieldOption) {
    //                     $payway = $fieldOption->option_en;
    //                 }
    //             }
    //             OrderForm::create([
    //                 'order_id' => $order->id,
    //                 'field_id' => $data['field_id'],
    //                 'value' => $data['value'],
    //             ]);
    //         }

    //         $total = $order->services->price - $order->services->discount;
    //         $order->price =  $order->services->price;
    //         $order->discount = $order->services->discount;
    //         $order->total  = $total;
    //         OrderForm::create([
    //             'order_id' => $order->id,
    //             'field_id' => 6,
    //             'value' => $order->price,
    //         ]);
    //         OrderForm::create([
    //             'order_id' => $order->id,
    //             'field_id' => 7,
    //             'value' => $order->discount,
    //         ]);
    //         OrderForm::create([
    //             'order_id' => $order->id,
    //             'field_id' => 8,
    //             'value' => $total,
    //         ]);
    //         $order->save();
    //         $amount = $total;

    //         return $this->onSuccess(200, 'Service Success', 'dadada');

    //         if ($payway == 'Cash') {
    //             return $this->onSuccess(200, 'Service Success', 'dadada');
    //         } else {
    //             return $this->onSuccess(200, 'Service Success', 'dadada');
    //         }
    //     } else {
    //         // Handle the case where form data is not a valid JSON string
    //         return response()->json(['error' => 'Invalid form data'], 400);
    //     }
    // }

    
    public function storeOrderForm(Request $OrderFormRequest)
    {
        $request = $OrderFormRequest;
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

        $ar = json_decode($formData, true);
        //$ar=$formData;
        foreach ($ar as $data) {
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

        return $this->onSuccess(200, 'Service Success');


        //   return response("Order Created Successfully",200);

        if ($payway == 'Cash') {



            //     return $this->pay($amount, $order);

            return $this->onSuccess(200, 'Service Success',  'dadada');
        } else {

            return $this->onSuccess(200, 'Service Success',  'dadada');


            // return $this->pay($amount, $order);


        }
    }
    function createPrepayUrl($order)
    {

        $mid = 'MID-25253-674'; //your merchant id
        $amount = '80'; //eg: 100
        $currency = 'EGP'; //eg: "EGP"
        $orderId = '255'; //eg: 99, your system order ID
        $secret = '3b97bc23-fac2-4fa1-9aa0-8cb99a6b87fa';
        $path = "/?payment=." . $mid . "." . $orderId . "." . $amount . "." . $currency;
        $hash = hash_hmac('sha256', $path, $secret, false);
        $merchantRedirect = route('verify-payment');
        return 'https://checkout.kashier.io/?merchantId=MID-25253-674&orderId=' . $orderId . '&amount=' . $amount . '&currency=EGP&hash=' . $hash . '&mode=test&metaData={"metaData":"myData"}&merchantRedirect=https://soitmed.onclick-eg.com/payments/verify&allowedMethods=card,bank_installments,wallet&failureRedirect=true&redirectMethod=get&brandColor=%2300bcbc&display=ar';
    }

    public function pay(float $amount, $order)
    {
        $PrepayUrl = $this->createPrepayUrl($order);
        // Perform authentication request
        // dd($PrepayUrl);


        $authResponse = PayMob::AuthenticationRequest();
        return $authResponse;


        // Construct the redirect URL with token
        //$redirectUrl = "https://soitmed.onclick-eg.com/payments/verify/{$paymentKeyResponse->token}";

        // Redirect the user to PayMob payment page
        //return redirect()->away($redirectUrl);

    }

    public function updateOrderStatus(Order $Order)
    {
        $Order = $this->OrderService->updateOrderStatus($Order);
        return response("Order Updated Successfully", 200);
    }
}
