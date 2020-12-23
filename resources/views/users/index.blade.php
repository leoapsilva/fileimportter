@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @livewire('users-table')
        </div>
    </div><!--/.row-->
@endsection

@section('extra_js')
@endsection
