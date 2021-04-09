<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
// use Nexmo\Laravel\Facade\Nexmo;
use Session;

class SmsController extends Controller
{
   
 
    public function sendMessage(Request $request){
     
        $otp = rand(10000,99999);
        Session::put('OTP',$otp);
        Session::put('contact_number',$request->contact_number);
        $authKey= env('sms_api');
        $senderId='31001';
        $data = array(
          'auth_token' => $authKey,
          'from'=>'9861042209',
          'to' => $request->contact_number,
          'text'=>'Your mobile verification code for '.config('app.name').' is '.$otp,
        );
  
        $url = "https://sms.aakashsms.com/sms/v3/send" ;
        $ch = curl_init();
  
        curl_setopt_array($ch, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST =>true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
        ));
  
        $response = curl_exec($ch);
        $err = curl_error($ch);
  
        if ($err) {
        echo "cURL Error #:" . $err;
        }
        curl_close($ch);
        // return redirect()->back();
        return response()->json(['success','Verification code succefully sent to your phone. '],200);
      }
  
      public function updateContact(Request $request){
          $this->validate($request ,[
              'otp' => 'required',
          ]);
          if($request->otp == $request->session()->get('OTP')){
            $user = User::where('id',Auth::id())->firstOrFail();
            $user->phone = $request->session()->get('contact_number');
            $user->phone_verified = true;
            $user->update();
            $request->session()->forget('contact_number');
            $request->session()->forget('OTP');
            $message="Contact number verified succefully";
            return response()->json(['success',$message],200);
          }else{
            $message="OTP Code doesn`t match";
            return response()->json(['error',$message],200);
          }
  
  
      }
}
