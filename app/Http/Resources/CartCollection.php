<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'product' => [
                        'name' => $data->product->name,
                        'image' => $data->product->thumbnail_img,
                        'available_stock' => $data->product->current_stock,
                    ],
                    'variation' => $data->variation,
                    'price' => (double) $data->price,
                    'tax' => (double) $data->tax,
                    'shipping_cost' => (double) $data->shipping_cost,
                    'quantity' => (integer) $data->quantity,
                    'product_id' => $data->product->id,
                    
                    'date' => $data->created_at->diffForHumans(),
                    
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
    
    public function grandTotal($datas){

$admin_products = [];
$seller_products = [];
        foreach($datas as $key => $data)
         $product = \App\Product::find($data['id']);
                        if($product->added_by == 'admin'){
                            array_push($admin_products, $data['id']);
                        }
                        else{
                            $product_ids = array();
                            if(array_key_exists($product->user_id, $seller_products)){
                                $product_ids = $seller_products[$product->user_id];
                            }
                            array_push($product_ids, $data['id']);
                            $seller_products[$product->user_id] = $product_ids;
                        }
                        $subtotal += $data['price']*$data['quantity'];
                        $tax += $data['tax']*$data['quantity'];
                        if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping') {
                            $shipping += $data['shipping'];
                        }
                        $product_name_with_choice = $product->name;
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->name.' - '.$data['variant'];
                        }
    
    dd($seller_products);
    }
}
