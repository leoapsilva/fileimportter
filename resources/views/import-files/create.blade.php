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

                    <form class="form-horizontal" action="/import-files" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <fieldset>
                            <!-- Model input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="model"> {{ __('import-files.model') }} </label>
                                <div class="col-md-9 {{ $errors->first('model') ? 'form-group has-error' : ''}}">
                                    <select id="model" name="model" class="form-control" required>
                                        @foreach ($models as $model)
                                            <option value="{{ $model['model'] }}">{{ $model['name'] .': '. $model['format'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('model')
                                    <div class="alert alert-danger"> {{ __($message) }} </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- File input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="csv_file"> {{ __('import-files.filename') }} </label>
                                <div class="col-md-9 {{ $errors->first('csv_file') ? 'form-group has-error' : ''}}">
                                    <input id="csv_file" name="csv_file" type="file" placeholder="" class="form-control" required>
                                    @error('csv_file')
                                        <div class="alert alert-danger"> {{ __($message) }} </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Synch Process input -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="synch"> {{ __('import-files.process') }} </label>
                                <div class="col-md-9 {{ $errors->first('synch') ? 'form-group has-error' : ''}}">
                                    <select id="process" name="process" class="form-control" required>
                                            <option value="job-asynch">{{ __('import-files.job-asynch') }}</option>
                                            <option value="synch">{{ __('import-files.synch') }}</option>
                                    </select>
                                    @error('synch')
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
                                        <button type="button" class="btn btn-warning btn-md pull-left" onclick="location.href='/import-files'">{{ __("navbar.back") }}</button>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-md pull-right">{{ __("navbar.send" ) }}</button>
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
