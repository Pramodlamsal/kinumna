<?php

namespace App\Exports;

use App\User;
use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        // return Customer::orderBy('created_at', 'desc');
        // dd(Customer::with('user')->take(10)->get());
        

             $customer_array[] = array('Name', 'Address');
        foreach(Customer::with('user')->take(10)->get() as $cust){
               $customer_array[] = array(
       'Customer Name'  => $cust->user->name,
        'Mobile'        => $cust->user->mobile,
      );
        }
        // dd(Customer::with('user')->get());
        // return Customer::with('user')->get();
        // dd($customer_array);
        // return $customer_array;
        return new Collection([
            ['Customer Name', 'Mobile'],
            [ 1, 3]
        ]);
    }
}
