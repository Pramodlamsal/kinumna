@extends('frontend.layouts.app')
@section('title', 'ImePay')

@section('content')

<div class="container col-md-6 mt-5 mb-5 p-5">
<div class="text-center">
         <div class="payment-method__container box-shadow">
            <div class="content">
                <form action="https://stg.imepay.com.np:7979/WebCheckout/Checkout " method="post">
                    <input type="hidden" name="TokenId" value="{{$token_response->TokenId}}">
                    <input type="hidden" name="MerchantCode" value="{{$merch_code}}">
                    <input type="hidden" name="TranAmount" value="{{$token_response->Amount}}">
                    <input type="hidden" name="RefId" value="{{$token_response->RefId}}">
                    <input type="hidden" name="Method" value="get">
                    <input type="hidden" name="CancelUrl" value="{{route('cart')}}">
                    <input type="hidden" name="RespUrl" value="{{url('imepay/confirm')}}">
                    <button type="submit" class="btn btn-danger col-md-12">Continue To IME Pay</button>
                </form>
            </div>
        </div>
        </div>    
        </div>
   
@endsection