@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('dashboard-content')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @livewire('customers-table')
        </div>
    </div><!--/.row-->
@endsection

@section('extra_js')
@endsection
