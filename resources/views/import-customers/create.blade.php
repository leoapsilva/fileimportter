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

                    <form class="form-horizontal" action="/import-customers" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <fieldset>
                            <!-- File input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="csv_file"> {{ __('import-customers.filename') }} </label>
                                <div class="col-md-9 {{ $errors->first('csv_file') ? 'form-group has-error' : ''}}">
                                    <input id="csv_file" name="csv_file" type="file" placeholder="" class="form-control" required>
                                    @error('csv_file')
                                    <div class="alert alert-danger"> {{ __($message) }} </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- User hidden input-->
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id}}">
                            
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
