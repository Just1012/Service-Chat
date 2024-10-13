<?php

namespace App\Http\Helpers;

use App\Models\Order;
use Carbon\Carbon;

class Kashier
{
    private $headers;
    private $currency;
    private $baseUrl;
    private $merchantId;
    private $lang;

    public function __construct($currency, $lang)
    {
        $this->headers = [
            'Authorization' =>env('KASHIER_SECRET_KEY'),
        ];
        $this->baseUrl = env('KASHIER_BASE_URL');
        $this->merchantId = env('KASHIER_MERCHANT_ID');
        $this->currency = $currency;
        $this->lang = $lang;
    }

    public function CreateInvoice(Order $order)
    {
        $body = [
            "paymentType" => "professional",
            "merchantId"=> $this->merchantId,
            "customerName"=> $order->full_name,
            "dueDate"=>Carbon::now()->addDay()->format('Y-m-d\TH:i:s.u\Z'),
            "isSuspendedPayment"=>true,
            "description"=> "order from Kashier Demo",
            "invoiceReferenceId"=> $order->invoice_reference_id,
            "invoiceItems"=> $order->orderItems->map(function ($item) {
                return [
                    'description' => $item->product->description,
                    'quantity' => $item->quantity,
                    'itemName' => $item->product->name,
                    'unitPrice' => $item->product->price,
                    'subTotal' => $item->product->price * $item->quantity,
                ];
            }),
            "state"=> "submitted",
            "currency"=> $this->currency
        ];
        $url = $this->baseUrl . '/paymentRequest/?currency='. $this->currency;
        $response = NetworkCalls::apiPost($url, $body, $this->headers);
        $resBody =json_decode($response->getBody());
        if($response->status() != 200){
            throw new \Exception($resBody->message , 1);
        }

        return $resBody->response;
    }
    public function ShareInvoiceByEmail(Order $order)
    {

        $body = [
            "subDomainUrl"=> env('SUB_DOMAIN_URL'),
            "urlIdentifier"=> $order->payment->invoice_kash_id,
            "customerName"=> $order->full_name,
            "storeName"=> env('STORE_NAME'),
            "customerEmail"=> $order->email,
            "language"=> $this->lang,
            "operation"=> "email"
        ];
        $url = $this->baseUrl . '/paymentRequest/sendInvoiceBy?operation=share_payment_Request&currency='. $this->currency;

        $response = NetworkCalls::apiPost($url, $body, $this->headers);
        $resBody =json_decode($response->getBody());
        if($response->status() != 200){
            throw new \Exception($resBody->message , 1);
        }
    }
}