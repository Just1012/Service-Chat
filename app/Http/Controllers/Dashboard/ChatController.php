<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Messages;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ChatController extends Controller
{
    public function index($id)
    {

        $conversations = Conversation::query()
            ->where(function ($query) {
                $query->where('customer', Auth()->user()->id)
                    ->orWhere('engineer', Auth()->user()->id);
            })
            ->where('order_id', $id)
            ->get();


        foreach ($conversations as $conversation) {
            $messages = Messages::with('conversation.order.services')->where('conversation_id', '=', $conversation->id)->get();
        }
        $order = Order::with('services')->find($id);

        if ($order->send_to == Auth()->user()->id || Auth()->user()->id == 2) {
            return view('dashboard.chat', compact('messages', 'order', 'conversations'));
        } else {
            Toastr::warning(__('غير مصرح لك بالدخول علي هذه المحادثة'), __('تحذير'));
            return redirect()->back();
        }
    }

    public function sendMessage(Request $request)
    {
        // Assuming the request contains 'conversation_id'
        $conversationId = $request->input('conversation_id');
        // Fetch the order with its related conversation
        $order = Order::whereHas('conversation', function ($query) use ($conversationId) {
            $query->where('id', $conversationId);
        })
            ->with('conversation')
            ->first();

        if($order->status == 3){
            Toastr::warning(__('تم غلق هذه المحادثة'), __('تحذير'));
            return redirect()->back();
        }else{
            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'body' => 'required|string|max:1000',
            ]);
    
            Messages::create([
                'user_id' => Auth::id(),
                'conversation_id' => $request->conversation_id,
                'body' => $request->body,
                'is_seen' => 0,
            ]);
    
            return back()->with('success', 'Message sent successfully!');
        }
    }



    public function lockChat($id)
    {
        try {

            $order = Order::findOrFail($id);
            if ($order->status == 3) {
                toastr()->info(__('المحادثة مغلقة بالفعل'), __('ملحوظة'));
                return redirect()->back();
            } else {
                $order->status = 3;
                $order->save();
                toastr()->success(__('تم غلق المحادثة بنجاح'), __('تم بنجاح'));
                return redirect()->back();
            }
        } catch (ModelNotFoundException $exception) {
            toastr()->error(__('Chat Not Found'), __('Error'));
            return redirect()->back();
        } catch (\Throwable $th) {
            toastr()->error(__('Something went wrong. Please try again.'), __('Error'));
            return redirect()->back();
        }
    }
}
