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

                    <form class="form-horizontal" action="/customers/{{ $customer->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <fieldset>
                                <!-- Title input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="title"> {{ __('customers.title') }} </label>
                                    <div class="col-md-9 {{ $errors->first('title') ? 'form-group has-error' : ''}}">
                                        <input id="title" name="title" type="text" placeholder="" class="form-control" value="{{ old('title', $customer->title) }}">
                                        @error('title')
                                        <div class="alert alert-danger"> {{ __($message) }} </div>
                                        @enderror
                                    </div>
                                </div>
    
                                <!-- Firstname input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="first_name"> {{ __('customers.first_name') }} </label>
                                    <div class="col-md-9 {{ $errors->first('first_name') ? 'form-group has-error' : ''}}">
                                        <input id="first_name" name="first_name" type="text" placeholder="" class="form-control" value="{{ old('name', $customer->first_name) }}">
                                    </div>
                                </div>
                            
                                <!-- Lastname input-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="last_name">{{ __('customers.last_name') }} </label>
                                    <div class="col-md-9 {{ $errors->first('last_name') ? 'form-group has-error' : ''}}">
                                        <input id="lastname" name="last_name" type="text" placeholder="" class="form-control" value="{{ old('last_name', $customer->last_name) }}">
                                    </div>
                                </div>
                                
                                <!-- email input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="email">{{ __('customers.email') }} </label>
                                    <div class="col-md-9 {{ $errors->first('email') ? 'form-group has-error' : ''}}">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="" value="{{ old('email', $customer->email) }}">
                                        @error('email')
                                        <div class="alert alert-danger"> {{ __($message) }} </div>
                                        @enderror
                                    </div>
                                </div>
    
                                <!-- Gender input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="gender">{{ __('customers.gender') }} </label>
                                    <div class="col-md-9 {{ $errors->first('gender') ? 'form-group has-error' : ''}}">
                                        <input type="text" id="gender" name="gender" class="form-control" placeholder="" value="{{ old('gender', $customer->gender) }}">
                                    </div>
                                </div>
    
                                <!-- IP Address input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="ip_address">{{ __('customers.ip_address') }} </label>
                                    <div class="col-md-9 {{ $errors->first('ip_address') ? 'form-group has-error' : ''}}">
                                        <input type="text" id="ip_address" name="ip_address" class="form-control" placeholder="" value="{{ old('ip_address', $customer->ip_address) }}">
                                        @error('ip_address')
                                        <div class="alert alert-danger"> {{ __($message) }} </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Company input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="company">{{ __('customers.company') }} </label>
                                    <div class="col-md-9 {{ $errors->first('company') ? 'form-group has-error' : ''}}">
                                        <input type="text" id="company" name="company" class="form-control" placeholder="" value="{{ old('company', $customer->company) }}">
                                    </div>
                                </div>
    
                                <!-- City input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="city">{{ __('customers.city') }} </label>
                                    <div class="col-md-9 {{ $errors->first('city') ? 'form-group has-error' : ''}}">
                                        <input type="text" id="city" name="city" class="form-control" placeholder="" value="{{ old('city', $customer->city) }}">
                                    </div>
                                </div>
    
                                <!-- Website input -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="website">{{ __('customers.website') }} </label>
                                    <div class="col-md-9 {{ $errors->first('website') ? 'form-group has-error' : ''}}">
                                        <input type="text" id="website" name="website" class="form-control" placeholder="" value="{{ old('website', $customer->website) }}">
                                        @error('website')
                                        <div class="alert alert-danger"> {{ __($message) }} </div>
                                        @enderror
                                    </div>
                                </div>
                                
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 widget-right">

                                    <div class="col-md-10 widget-left">
                                    </div>
                                    <div class="col-md-1 widget-right">
                                        <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/customers'">Voltar</button>
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
