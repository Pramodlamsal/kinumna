<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response()->json([
            'success' => true,
            'message' => 'Your address has been added',
            'data'=> Auth::user()->addresses,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            // 'postal_code' => 'required|string',
            'phone' => 'required|int'
            ]);
        $address = new Address;
        $address->user_id = Auth::user()->id;
        $address->address = $request->address;
        $address->country = $request->country;
        $address->city = $request->city;
        // $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->district_id = $request->district;
        // dd($address);
        $address->save();

    //   return response()->json([
    //         'success' => true,
    //         'message' => 'Your address has been added'
    //     ]);
     flash('Address added successfully')->success();  
       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        if(!$address->set_default){
            $address->delete();
            return response()->json([
            'success' => true,
            'message' => 'Your address has been deleted'
        ]); 
        }
        else{
             return response()->json([
            'success' => false,
            'message' => 'Default address can not be deleted',
        ]); 
        }
       
           
    }

    public function set_default($id)
    {
        
        foreach (Auth::user()->addresses as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        
        $address = Address::findOrFail($id);
        $address->set_default = 1;
        $address->save();
        return response()->json([
            'success' => true,
            'message' => 'Default address changed',
        ]); 
    }
}
