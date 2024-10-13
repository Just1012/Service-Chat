<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Order;
use App\Models\Messages;

class ChatController extends Controller
{
    public function getConversation($id)
    {
        // Retrieve the conversations where the user is either the customer or the engineer
        $conversations = Conversation::query()
            ->where(function ($query) {
                $query->where('customer', Auth()->user()->id)
                    ->orWhere('engineer', Auth()->user()->id);
            })
            ->where('order_id', $id)
            ->first();

        // Initialize an array to hold messages
        $allMessages = [];

        // Retrieve messages for each conversation
        // foreach ($conversations as $conversation) {
        $messages = Messages::with('conversation')
            ->where('conversation_id', '=', $conversations->id)
            ->latest()
            ->get();

        // Append messages to the allMessages array
        foreach ($messages as $message) {
            $message['is_seen'] = 1;
            $allMessages[] = $message;
        }
        // }

        // Retrieve the order and its related services
        $order = Order::with('services')->find($id);

        // Return the data as a JSON response
        return response()->json([
            'conversations' => $conversations,
            'messages' => $allMessages,
            'order' => $order
        ], 200);
    }
    public function getConversationsForUser(Request $request)
    {

        $conversations = Conversation::query()
        ->where(function ($query) {
            $query->where('customer', Auth::user()->id)
                  ->orWhere('engineer', Auth::user()->id);
        })
        ->when($request->order_id, function ($query, $orderId) {
            $query->where('order_id', '=', $orderId);
        })
        ->when($request->filled('status'), function ($query) use ($request) {
            $query->whereHas('order', function ($query) use ($request) {
                if ($request->status == 0) {
                    $query->where('status', '!=', 3);
                } elseif ($request->status == 1) {
                    $query->where('status', '=', 3);
                }
            });
        })
        ->with('order')
        ->get();

        $conversationMessages = collect();

        foreach ($conversations as $conversation) {
            $lastMessage = Messages::where('conversation_id', $conversation->id)
                ->latest()
                ->first();
            if ($conversation->order) {
                $conversation->order->lastMessage = isset($lastMessage) ? $lastMessage->body : null;
                $conversation->order->lastMessageTime = isset($lastMessage) ? $lastMessage->created_at : $conversation->order->created_at;
                $conversation->order->photo =  $conversation->order->services->image;
                $conversation->order->titleAr =  $conversation->order->services->name_ar;
                $conversation->order->titleEn =  $conversation->order->services->name_en;
                $conversation->order->engName =  $conversation->order->delivary->name;

                $conversationMessages->push($conversation->order);
                $conversation->order->makeHidden('services');
                $conversation->order->makeHidden('delivary');
            }
        }
        $conversationMessages = $conversationMessages->sortByDesc("lastMessageTime");

        return response()->json([
            'data' => $conversationMessages->values(),
        ], 200);
    }



    public function sendMessage(Request $request)
    {

        $conversations = Conversation::where('order_id', $request->order_id)
            ->first();
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Messages::create([
            'user_id' => Auth::id(),
            'conversation_id' => $conversations->id,
            'body' => $request->body,
            'is_seen' => 0,
        ]);
        return response()->json([

            'messages' => "Message sent Successfully",
        ], 200);
    }
}
