@extends('frontend.layouts.app')

@section('content')
    <fieldset class="container col-md-6">
        <section class="content-box-row">
            <div class="content-box">
                <div class="row ">
                        <div class="thankyou--border-box">
            	            <span class="text txt-info mb-2 text-center align-item-center">
            	                <h4>Payment Confirmation</h4>
            	            </span>
                            <div class="content mb-4">
                           
                           <table class="table table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#RefId</th>
      <th scope="col">Transaction Id</th>
      <th scope="col">Transaction Amount</th>
      <th scope="col">Msisdn</th>
      <th scope="col">Status</th>
      
    </tr>
  </thead>
  <tbody>
        <tr>
      <th scope="row" class="col-md-2">{{$response[4]}}</th>
      <td>{{$response[3] ?? 'N/A'}}</td>
      <td>{{$response[5]}}</td>
      <td>{{$response[2] ?? 'N/A'}}</td>
      @if($response[0] == 0)
      <td class="text-success">{{$response[1]}}</td>
      @else
       <td class="tex-warning">{{$response[1]}}</td>
       @endif
    </tr>
  </tbody>
</table>

             <form action="{{url('payment/confirm')}}" method="post" id="imeSuccess">
                 {{csrf_field()}}
                 <input type="hidden" value="{{$response[3]}}" name="TransactionId">
                 <input type="hidden" value="{{$response[4]}}" name="RefId">
                 <input type="hidden" value="{{$response[2]}}" name="Msisdn">
                 <input type="hidden" value="{{$response[0]}}" name="ResponseCode">
                 <input type="hidden" value="{{$response[6]}}"   name="TokenId">
                 @if($response[0] == 0)
                 <button type="submit" class="btn btn-success">Confirm</button>
                 @else
                  <a href="{{url('cart')}}" class="btn btn-danger">Try Again</button>
                  @endif
             </form>
                           
                           
                  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </fieldset>
@endsection
