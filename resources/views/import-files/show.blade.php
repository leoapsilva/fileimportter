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
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em
                        class="fa fa-toggle-up"></em></span>
            </div>
            <div class="panel-body">

                <form class="form-horizontal" action="/importFiles" method="GET">
                    <fieldset>
                        <!-- Created at -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="created_at"> {{ __('import-files.created_at') }}
                            </label>
                            <div class="col-md-9 {{ $errors->first('created_at') ? 'form-group has-error' : ''}}">
                                <input disabled id="created_at" name="created_at" type="text" placeholder=""
                                    class="form-control"
                                    value="{{ Carbon\Carbon::parse($importFile->created_at)->format("d/m/Y H:i") }}">
                            </div>
                        </div>

                        <!-- User -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="user_id"> {{ __('import-files.user_id') }}
                            </label>
                            <div class="col-md-9 {{ $errors->first('user_id') ? 'form-group has-error' : ''}}">
                                <input disabled id="user_id" name="user_id" type="text" placeholder=""
                                    class="form-control" value="{{ $importFile->user_id }}">
                            </div>
                        </div>

                        <!-- Filename input -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="filename">{{ __('import-files.filename') }}
                            </label>
                            <div class="col-md-9 {{ $errors->first('filename') ? 'form-group has-error' : ''}}">
                                <input disabled type="text" id="filename" name="filename" class="form-control"
                                    placeholder="" value="{{ $importFile->filename }}">
                            </div>
                        </div>

                        <!-- Count -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="count">{{ __('import-files.count') }} </label>
                            <div class="col-md-9 {{ $errors->first('count') ? 'form-group has-error' : ''}}">
                                <input disabled id="count" name="count" type="text" placeholder="" class="form-control"
                                    value="{{ $importFile->count }}">
                            </div>
                        </div>

                        <!-- Model input -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="model">{{ __('import-files.model') }} </label>
                            <div class="col-md-9 {{ $errors->first('model') ? 'form-group has-error' : ''}}">
                                <input disabled type="model" id="model" name="model" class="form-control" placeholder=""
                                    value="{{ $importFile->model }}">
                                @error('model')
                                <div class="alert alert-danger"> {{ __($message) }} </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data  -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="data">{{ __('import-files.data') }} </label>
                            <div class="col-md-9 {{ $errors->first('data') ? 'form-group has-error' : ''}}">
                                <textarea disabled id="data" name="data" class="form-control"
                                    rows="10"> {{ json_encode(json_decode($importFile->data), JSON_PRETTY_PRINT) }} </textarea>
                            </div>
                        </div>

                        <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <div class="col-md-10 widget-left">
                                    </div>
                                    <div class="col-md-1 widget-right">
                                    </div>

                                    <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/import-files'">{{ __("navbar.back") }}</button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection

@section('extra_js')
@endsection
