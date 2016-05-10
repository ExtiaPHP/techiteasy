@extends('layouts.master')

@section('title', trans('content.login_page_title'))

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{!! trans('content.login_title') !!}</h3>
        </div>
        <div class="panel-body">
              {!! Form::open(array('url' => 'login', 'method' => 'post')) !!}
                <fieldset>
                    <div class="form-group">
                        {!! Form::text('email', '', array('class' => 'form-control', 'placeholder' => trans('content.login_email'), 'required' => 'required')) !!}
                    </div>
                    <br/>
                    <div class="form-group">
                         {!! Form::text('firstName', '', array('class' => 'form-control', 'placeholder' => trans('content.login_firstname'), 'required' => 'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('lastName', '', array('class' => 'form-control', 'placeholder' => trans('content.login_lastname'), 'required' => 'required')) !!}
                    </div>
                    <button type="submit" class="btn btn-lg btn-extia btn-block">{!!  trans('content.login_button') !!} <i class="fa fa-rocket"></i></button>
                </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
