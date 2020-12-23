@extends('layout')

@php
    $nav = explode("/", Request::path())[0];
@endphp 

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                {{ __("navbar.".$nav) }}
                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" action="/users/{{ $user->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <fieldset>
                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name"> {{ __('users.name') }} </label>
                                <div class="col-md-9">
                                    <input disabled id="name" name="name" type="text" placeholder="" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                        
                            <!-- E-mail input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">{{ __('users.email') }} </label>
                                <div class="col-md-9">
                                    <input disabled id="email" name="email" type="text" placeholder="" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                            
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <div class="col-md-9 widget-left">
                                    </div>
                                    <div class="col-md-1 widget-right">
                                        <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/users'">Voltar</button>
                                    </div>
                                        <button type="submit" class="btn btn-danger btn-md pull-right">Confirmar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div><!--/.row-->
@endsection

@section('extra_js')
@endsection
