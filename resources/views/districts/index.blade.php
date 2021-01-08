@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('districts.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New district')}}</a>
        </div>
    </div><br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('District Information')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Shipping Charge')}}</th>
                        {{-- <th>{{__('Start Date')}}</th>
                        <th>{{__('End Date')}}</th> --}}
                        <th width="10%">{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $key => $district)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$district->name}}</td>
                            <td>{{$district->shipping_charge}}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('districts.edit', encrypt($district->id))}}">{{__('Edit')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('districts.destroy', $district->id)}}');">{{__('Delete')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
