<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NicpayController extends Controller
{
    // private static $apiuser;
    // private static $password;
    // private static $module;
    // private static $merchantcode;

    // public function __construct()
    // {
    //     // self::$apiuser = config('nicPay.apiuser');
    //     // self::$password = config('nicPay.password');
    //     // self::$module = config('nicPay.module');
    //     // self::$merchantcode = config('nicPay.merchant_code');
    // }

    public static function index()
    {
        // dd('testing');
        // $token_responses = static::getToken($amount, $refId);
       

        // $token_response = json_decode($token_responses);
        // nicTransaction::create([
        //     'MerchantCode' => self::$merchantcode,
        //     'TranAmount' => $token_response->Amount,
        //     'RefId' => $token_response->RefId,
        //     'TokenId' => $token_response->TokenId,
        // ]); //store in table

        // $merch_code = self::$merchantcode;

        return view('frontend.nicPay');
    }

//     private static function getToken($amt, $ref_id)
//     {
        
//         $data = ["MerchantCode" => self::$merchantcode, "Amount" => $amt, "RefId" => $ref_id];

//         $header_array = [];
//         $header_array[] = "Authorization: Basic " . base64_encode(self::$apiuser . ":" . self::$password);
//         $header_array[] = "Module: " . base64_encode(self::$module);
//         $header_array[] = "Content-Type: application/json";
//         // Initializing a cURL session
     
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, 'https://payment.nicpay.com.np:7979/api/Web/GetToken');
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//         $result = curl_exec($ch);
//         // dd($result);
//         curl_close($ch);

//         return $result;
//     }


//     public function transaction_status(Request $request)
//     {
//         if ($request) {
//                     $latest_transaction = nicTransaction::latest('created_at')->first();
//             $rechecked_json = static::reconfirm($latest_transaction->MerchantCode, $latest_transaction->TokenId, $latest_transaction->RefId);
//             $rechecked = json_decode($rechecked_json);
//             if ($rechecked->ResponseCode == "0") {
//                 $latest_transaction->TransactionId = $rechecked->TransactionId;
//                 $latest_transaction->Msisdn = $rechecked->Msisdn;
//                 $latest_transaction->TranStatus = $rechecked->ResponseCode;
//                 $latest_transaction->StatusDetail = "Success";
//             } else {
//                 $latest_transaction->TransactionId = $rechecked->TransactionId;
//                 $latest_transaction->Msisdn = $rechecked->Msisdn;
//                 $latest_transaction->TranStatus = $rechecked->ResponseCode;
//                 $latest_transaction->StatusDetail = "Not Found or Failed";
//             }
//               $order = Order::where('code',$code)->firstOrFail();
//             return view("frontend.order_confirmed",compact('order'))->with('message', "Transaction Failed. Try again or contact the respective firm!");
//         }
//     }

//     private static function confirm($ref_id, $merch_code, $transaction_id, $msisdn, $token_id)
//     {
//         $data = ["TransactionId" => $transaction_id, "MerchantCode" => $merch_code, "Msisdn" => $msisdn, "RefId" => $ref_id,"TokenId" => $token_id];
//         $header_array = [];
//         $header_array[] = "Authorization: Basic " . base64_encode(self::$apiuser . ":" . self::$password);
//         $header_array[] = "Module: " . base64_encode(self::$module);
//         $header_array[] = "Content-Type: application/json";
//         // Initializing a cURL session
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, 'https://payment.nicpay.com.np:7979/api/Web/Confirm');
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         $result = curl_exec($ch);

//         curl_close($ch);
//         return $result;

//     }

//     private static function reconfirm($MerchantCode, $TokenId, $RefId)
//     {

//         $data = ["MerchantCode" => $MerchantCode, "TokenId" => $TokenId, "RefId" => $RefId];
//         $header_array = [];
//         $header_array[] = "Authorization: Basic " . base64_encode(self::$apiuser . ":" . self::$password);
//         $header_array[] = "Module: " . base64_encode(self::$module);
//         $header_array[] = "Content-Type: application/json";
//         // Initializing a cURL session
//         $ch = curl_init();
//         curl_setopt($ch, CURLOPT_URL, 'https://payment.nicpay.com.np:7979/api/Web/Recheck');
//         curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//         $result = curl_exec($ch);
//         curl_close($ch);
//         return $result;
//     }

    
//     public function paymentSuccess(Request $request){
//         if($request){
//             $responseData = base64_decode($request->data);
//             $response = explode('|', $responseData);
//             $request->session()->put('nicPayResponse',$response);
//              return redirect()->route('nicpay.success');
            
//         }else{
//             return 'Something Went Wrong !! Try Again later';
//         }
        
//     }
    
//     public function confirmSuccess()
//     {
//  $response  = session()->get('nicPayResponse');

//        return view('frontend.nicPaySuccess',compact('response'));
//     }
    
    

//     public function cancel(Request $request){
        
//         if($request){
//             $responseData = base64_decode($request->data);
//             $response = explode('|', $responseData);
           
//             return view('frontend.nicPaySuccess',compact('response'));
           
            
//         }else{
//             return 'Something Went Wrong !! Try Again later';
//         }
//     }
    
//     public function confirmPayment(Request $request)
//     {
//         if ($request) {
//             if ($request['ResponseCode'] == "0") {
//                 $row = nicTransaction::latest()->first();
//                 $row->TransactionId = $request['TransactionId'];
//                 $row->Msisdn = $request['Msisdn'];
//                 $row->TranStatus = $request['ResponseCode'];
//                 $row->StatusDetail = "Transaction Initiated";
//                 $row->save();
//                 sleep(5);
//                 $response_json = static::confirm($request['RefId'], $row['MerchantCode'], $request['TransactionId'], $request['Msisdn'],$request['TokenId']);
//                 $response = json_decode($response_json);
//                 $row->TranStatus = $response->ResponseCode;
//                 $row->StatusDetail = $response->ResponseDescription;
//                 $code = $request['RefId'];
//                 $row->save();
//                 $order = Order::where('code',$code)->firstOrFail();
//                 $order->payment_status = 'paid';
//                 $order->save();
//                 if($order->save())    {
//                 $request->session()->forget('cart'); 
                    
//                 }
//                  flash(__($row->StatusDetail))->success();
//                 return view("frontend.order_confirmed",compact('order'))->with('message', $row->StatusDetail);
//             }
//         }
//     }



}
