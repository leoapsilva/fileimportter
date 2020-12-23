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

                    <form class="form-horizontal" action="/customers/{{ $customer->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <fieldset>
                            <!-- Title input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="title"> {{ __('customers.title') }} </label>
                                <div class="col-md-9 {{ $errors->first('title') ? 'form-group has-error' : ''}}">
                                    <input disabled id="title" name="title" type="text" placeholder="" class="form-control" value="{{ $customer->title }}">
                                </div>
                            </div>

                            <!-- Firstname input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="first_name"> {{ __('customers.first_name') }} </label>
                                <div class="col-md-9 {{ $errors->first('first_name') ? 'form-group has-error' : ''}}">
                                    <input disabled id="first_name" name="first_name" type="text" placeholder="" class="form-control" value="{{ $customer->first_name }}">
                                </div>
                            </div>
                        
                            <!-- Lastname input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="last_name">{{ __('customers.last_name') }} </label>
                                <div class="col-md-9 {{ $errors->first('last_name') ? 'form-group has-error' : ''}}">
                                    <input disabled id="last_name" name="last_name" type="text" placeholder="" class="form-control" value="{{ $customer->last_name }}">
                                </div>
                            </div>
                            
                            <!-- email input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">{{ __('customers.email') }} </label>
                                <div class="col-md-9 {{ $errors->first('email') ? 'form-group has-error' : ''}}">
                                    <input disabled type="email" id="email" name="email" class="form-control" placeholder="" value="{{ $customer->email }}">
                                    @error('email')
                                    <div class="alert alert-danger"> {{ __($message) }} </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gender input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="gender">{{ __('customers.gender') }} </label>
                                <div class="col-md-9 {{ $errors->first('gender') ? 'form-group has-error' : ''}}">
                                    <input disabled type="text" id="gender" name="gender" class="form-control" placeholder="" value="{{ $customer->gender }}">
                                </div>
                            </div>

                            <!-- IP Address input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="ip_address">{{ __('customers.ip_address') }} </label>
                                <div class="col-md-9 {{ $errors->first('ip_address') ? 'form-group has-error' : ''}}">
                                    <input disabled type="text" id="ip_address" name="ip_address" class="form-control" placeholder="" value="{{ $customer->ip_address }}">
                                </div>
                            </div>
                            
                            <!-- Company input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="company">{{ __('customers.company') }} </label>
                                <div class="col-md-9 {{ $errors->first('company') ? 'form-group has-error' : ''}}">
                                    <input disabled type="text" id="company" name="company" class="form-control" placeholder="" value="{{ $customer->company }}">
                                </div>
                            </div>

                            <!-- City input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="city">{{ __('customers.city') }} </label>
                                <div class="col-md-9 {{ $errors->first('city') ? 'form-group has-error' : ''}}">
                                    <input disabled type="text" id="city" name="city" class="form-control" placeholder="" value="{{ $customer->city }}">
                                </div>
                            </div>

                            <!-- Website input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="website">{{ __('customers.website') }} </label>
                                <div class="col-md-9 {{ $errors->first('website') ? 'form-group has-error' : ''}}">
                                    <input disabled type="text" id="website" name="website" class="form-control" placeholder="" value="{{ $customer->website }}">
                                </div>
                            </div>
                            
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <div class="col-md-9 widget-left">
                                    </div>
                                    <div class="col-md-1 widget-right">
                                        <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/customers'">Voltar</button>
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
