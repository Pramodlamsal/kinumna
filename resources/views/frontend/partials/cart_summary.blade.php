<div class="card sticky-top">
    <div class="card-title py-3">
        <div class="row align-items-center">
            <div class="col-6">
                <h3 class="heading heading-3 strong-400 mb-0">
                    <span>{{__('Summary')}}</span>
                </h3>
            </div>

            <div class="col-6 text-right">
                <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{__('Items')}}</span>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = 0;
            @endphp
            @foreach (Session::get('cart') as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['id']);
                    $total_point += $product->earn_point*$cartItem['quantity'];
                    // dd($product);
                @endphp

            @endforeach
            <div class="club-point mb-3 bg-soft-base-1 border-light-base-1 border">
                {{ __("Total Club point") }}:
                <span class="strong-700 float-right">{{ $total_point }}</span>
            </div>
        @endif
        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="product-name">{{__('Product')}}</th>
                    <th class="product-total text-right">{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                    if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
                        $shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
                    // dd($shipping);
                    foreach(session()->get('cart') as $cart)
                    {
                        $shipping=$cart['shipping'];
                    }
                    }else{
                        $shipping=0;
                    }

                    // dd(Session::get('cart'));
                    // session::get('cart')->shipping = 10;
                    // dd(Session::get('cart'));
                    // dd($shipping);
                    $admin_products = array();
                    $seller_products = array();
                @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                        $product = \App\Product::find($cartItem['id']);
                        if($product->added_by == 'admin'){
                            array_push($admin_products, $cartItem['id']);
                        }
                        else{
                            $product_ids = array();
                            if(array_key_exists($product->user_id, $seller_products)){
                                $product_ids = $seller_products[$product->user_id];
                            }
                            array_push($product_ids, $cartItem['id']);
                            $seller_products[$product->user_id] = $product_ids;
                        }
                        $subtotal += $cartItem['price']*$cartItem['quantity'];
                        $tax += $cartItem['tax']*$cartItem['quantity'];

                            // $shipping += $cartItem['shipping'];
                            // dd($shipping);

                        $product_name_with_choice = $product->name;
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                        }
                    @endphp
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $product_name_with_choice }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                        </td>
                    </tr>
                @endforeach
                {{-- @php
                    if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
                        if(!empty($admin_products)){
                            $shipping = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
                        }
                        if(!empty($seller_products)){
                            foreach ($seller_products as $key => $seller_product) {
                                $shipping += \App\Shop::where('user_id', $key)->first()->shipping_cost;
                            }
                        }
                    }
                @endphp --}}
            </tbody>
        </table>

        <table class="table-cart table-cart-review">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{__('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>
@php
// dd(session()->all());
if(session()->get('coupon_id')){
    $id = session()->get('coupon_id');
    // $coupontype = session()->get('type');
    // dd($id);
    $coupontype= json_decode(App\ Coupon::select('type')->where('id', $id)->get()->first());

    // dd($coupontype->type);

    $coupon_detail= json_decode(App\ Coupon::findOrFail($id)->details);
// dd(json_decode(App\ Coupon::where('id',$id)->first()->details->product_id));
// dd($coupon_detail);
// if($coupon_detail['0']->product_id==Null){
    if($coupontype->type=='product_base'){
        foreach (Session::get('cart') as $key => $value) {
            # code...
            // if(Session::get('coupon_discont'))
            // {
            //     if($value['id'] !=  $coupon_detail[0]->product_id){
            //     //  dd('break');

            //     }
            // }

            // dd('yes');
        }
        // dd(Session::get('cart'));
        // dd($coupon_detail['0']->product_id);
        // dd(session('cart')->where('id',$id));

        // dd('yes');
        // dd('gh');
    }
    // dd('gh');
    if($coupontype->type=='cart_base'){


$minumnAmount = $coupon_detail->min_buy;
// $product_id = $coupon_detail->product_id;


// dd($minumnAmount);
if($minumnAmount>=$subtotal){
    Session::forget('coupon_discount');
}
 }
}
@endphp
                <tr class="cart-shipping">
                    <th>{{__('Tax')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price($tax) }}</span>
                    </td>
                </tr>
                <tr class="cart-shipping" id="shipping_price">
                    @if($shipping > 0)
                    <th>{{__('Shipping cost')}}</th>
                    <td class="text-right">
                        <span id="shipping_cost" class="text-italic">{{ single_price($shipping) }}</span>
                    </td>
                    @endif
                </tr>

                <tr class="cart-shipping" id="shipping_discount" name="shipping_discount" hidden="true">
                    <th>{{__('Shipping Discount')}}</th>
                    <td class="text-right">
                        <span id="shipping_cost" class="text-italic">{{ single_price($shipping) }}</span>
                    </td>
                </tr>

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{__('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                @php

                    // if(isset($_POST['shipping_discount'])){
                    //     dd('discount');
                    // }else{
                    //     dd('nodiscount');
                    // }
                        // dd($shipping);
                        // dd(Session::all());
                    $total = $subtotal+$tax + $shipping;
                    // dd($total);
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{__('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span id="totalPrice" data-total="{{ ($total) }}">{{ single_price($total) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{__('Have coupon code? Enter here')}}" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{__('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif

    </div>
</div>

