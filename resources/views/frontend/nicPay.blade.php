@extends('frontend.layouts.app')
@section('title', 'NicPay')

@section('content')

<div class="container col-md-6 mt-5 mb-5 p-5">
<div class="text-center">
         <div class="payment-method__container box-shadow">
            <div class="content">
                <form action="https://payment.imepay.com.np:7979/WebCheckout/Checkout" method="post">

                    <button type="submit" class="btn btn-danger col-md-12">Continue To NIC Pay</button>
                </form>
            </div>
        </div>
        </div>
        </div>

@endsection
