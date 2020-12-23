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

                    <form class="form-horizontal" action="/users/{{$user->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name"> {{ __('users.name') }} </label>
                                <div class="col-md-9 {{ $errors->first('name') ? 'form-group has-error' : ''}}">
                                    <input id="name" name="name" type="text" placeholder="" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                        
                            <!-- E-mail input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">{{ __('users.email') }} </label>
                                <div class="col-md-9 {{ $errors->first('email') ? 'form-group has-error' : ''}}">
                                    <input id="email" name="email" type="email" placeholder="" class="form-control" value="{{ $user->email }}">
                                    <p> {{ $errors->first('email') ? old('email'). ' '. $errors->first('email') : ''}} </p>
                                </div>
                            </div>
                            
                            <!-- Password input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="password">{{ __('users.password') }} </label>
                                <div class="col-md-9 {{ $errors->first('password') ? 'form-group has-error' : ''}}">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="" value="">
                                    <p> {{ $errors->first('password') }} </p>
                                </div>
                            </div>


                            <!-- Password input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="password-confirm">{{ __('users.password-confirm') }} </label>
                                <div class="col-md-9 {{ $errors->first('password-confirm') ? 'form-group has-error' : ''}}">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                            
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <div class="col-md-10 widget-left">
                                    </div>
                                    <div class="col-md-1 widget-right">
                                        <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/users'">Voltar</button>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-md pull-right">Enviar</button>
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
