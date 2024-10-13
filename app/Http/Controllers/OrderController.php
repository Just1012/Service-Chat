<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderForm;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Notifications\CustomNotification;

class OrderController extends Controller
{
    protected $OrderService;
    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
    }

    public function index()
    {
        $delivery = User::where('role_id', 4)->get();
        return view('dashboard.order.index', ['delivery' => $delivery]);
    }


    public function getOrders($value = null)
    {

        $user = auth()->user(); // Get the authenticated user

        // Fetch orders based on user's role
        $orders = Order::with(['services.category', 'delivary', 'usersOrder'])
            ->orderByDesc('created_at')
            ->when($value !== null, function ($query) use ($value) {
                return $query->where('status','=', $value);
            })
            ->when($user->role_id == 3, function ($query) use ($user) {
                // Fetch the categories for the authenticated user with role ID 3
                $categoryIds = $user->engineerCategory->pluck('category_id')->toArray();
                return $query->whereHas('services.category', function ($query) use ($categoryIds) {
                    $query->whereIn('id', $categoryIds);
                });
            })
            ->get();

        // Fetch users with at least one engineer category
        $users = User::whereHas('engineerCategory')->get();


        return response()->json([
            'data' => $orders,
            'message' => 'Found data'
        ]);
    }
    public function getOrderForm(Order $order)
    {
        $order1 = $this->OrderService->getOrder($order);
        return view('dashboard.order.orderForm', ['data' => $order1]);
    }

    public function updateOrderStatus(Order $Order)
    {
        $Order = $this->OrderService->updateOrderStatus($Order);
        return response("Order Updated Successfully", 200);
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $order = Order::findOrFail($id); // Find the order by ID
            $order->status = $request->input('status'); // Update the status
            $order->send_to = auth()->user()->id;
            $order->save(); // Save the changes

            $user = User::find($order->user_id);
            $service = Service::where('id', $order->services_id)->first();

            if ($order->status == 0) {
                $message = "قيد الانتظار";
            } elseif ($order->status == 1) {
                $message = "قبول";
            } elseif ($order->status == 2) {
                $message = "رفض";
            } elseif ($order->status == 3) {
                $message = "تم الانتهاء";
            }

            if($order->status == 1 && $service->type == 0){
                $conversation = Conversation::create([
                    'customer' => $order->user_id,
                    'engineer' => $order->send_to,
                    'order_id' => $order->id,
                ]);
            }



            $user->notify(new CustomNotification("حاله الطلب", $message));
            return response()->json([
                'message' => 'تم تحديث حالة الطلب بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء تحديث حالة الطلب'
            ], 500);
        }
    }
    public function updatedelivery(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id); // Find the order by ID
            $check = User::where('id', $request->input('delivery_id'))->where('role_id', '=', 4)->first();
            if ($order && $check) {
                $order->send_to = $request->input('delivery_id'); // Update the delivery ID
                $order->save(); // Save the changes

                $user = User::find($order->send_to);
                $user->notify(new CustomNotification(" طلب جديد", "تم إضافة طلب جديد اليك"));

                return response()->json([
                    'message' => 'تم اختيار السائق بنجاح'
                ]);
            } else {
                return response()->json([
                    'message' => 'حدث خطأ أثناء الاختيار'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'حدث خطأ أثناء الاختيار'
            ], 500);
        }
    }
}
