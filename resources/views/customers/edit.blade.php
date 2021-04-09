@extends('layouts.app')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Customer Information Update')}}</h3>
            </div>

            <form class="form-horizontal" action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
            	@csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="phone">{{__('Phone Number')}}</label>
                        <div class="col-lg-9">
                            <input type="number" value="{{ $customer->user->phone }}" name="phone" id="phone" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="mobile">{{__('Mobile Number')}}</label>
                        <div class="col-lg-9">
                            <input type="number" value="{{ $customer->user->mobile }}" name="mobile" id="mobile" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="email">{{__('Customer Email')}}</label>
                        <div class="col-lg-9">
                            <input type="email" value="{{ $customer->user->email }}" name="email" id="email" class="form-control"/>
                        </div>
                    </div>

                    {{-- <input type="hidden" name="id" value="{{ $customer->id }}" id="id"> --}}
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="name">{{__('Customer Name')}}</label>
                        <div class="col-lg-9">
                            <input type="text" value="{{ $customer->user->name }}" name="name" id="name" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="password">{{__('Password')}}</label>
                        <div class="col-sm-9">
                            <input type="password" placeholder="{{__('Password')}}" id="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div id="customer_form">

                    </div>

                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>

        </div>
    </div>


@endsection
