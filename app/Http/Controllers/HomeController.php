<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryServices;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryServices $CategoryService)
    {
        $this->middleware(['auth', 'staff_admin']);
        $this->CategoryService = $CategoryService;
    }
    protected $CategoryService;

    public function index()
    {
        $orders     = Order::all();
        $categories = Category::all();
        $delivery   = User::where('role_id', 3)->get();
        $users      = User::where('role_id', 1)->get();
        return view('welcome', compact('categories', 'orders', 'users', 'delivery'));
    }
    public function welcome()
    {
        $orders     = Order::all();
        $categories = Category::all();
        $delivery   = User::where('role_id', 4)->get();
        $users      = User::where('role_id', 1)->get();
        return view('home', compact('categories', 'orders', 'users', 'delivery'));
    }

    public function notification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('success', 'Notification Sent Successfully!!');
        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }

    public function payment_verify(Request $request)
    {
        $payment = new \Nafezly\Payments\Factories\PaymentFactory();
        $amount = 100;
        $id = 1;
        $first_name = "khaled";
        $last_name =  "khayri";
        $email = "khalidelfishawy@gmail.com";
        $phone = "01066663850";
        $currency = "EGP";
        $payName = "Paymob";
        $payment = $payment->get($payName)->pay(
            $amount,
            $user_id = $id,
            $user_first_name = $first_name,
            $user_last_name = $last_name,
            $user_email = $email,
            $user_phone = $phone,
            $source = null
        );
        return dd($payment);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
