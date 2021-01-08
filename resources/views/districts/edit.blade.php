@extends('layouts.app')

@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('District Information')}}</h3>
        </div>


        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('districts.update', $district->id) }}" method="POST" enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PATCH">
            @php
            // dd($district->id);
        @endphp
        	@csrf
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Name')}}" id="name" name="name" class="form-control" value="{{$district->name}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="shipping_charge">{{__('Shipping Charge')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Shipping Charge')}}" id="shipping_charge" name="shipping_charge" class="form-control" value="{{$district->shipping_charge}}" required>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
