@extends('layouts.master')

@section('title', 'Administration')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{!! trans('content.admin_login_title') !!}</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url' => '/auth/login', 'method' => 'post')) !!}
                    <fieldset>
                        <div class="form-group">
                            {!! Form::text('login', old('login'), array('class' => 'form-control', 'placeholder' => trans('content.admin_login_login'), 'autofocus')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::password('password', array('class' => 'form-control', 'placeholder' => trans('content.admin_login_password'))) !!}
                        </div>
                        <button type="submit" class="btn btn-lg btn-extia btn-block">{!! trans('content.admin_login_button') !!} <i class="fa fa-rocket"></i></button>
                    </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        @if (count($errors) > 0)
            $(function(){
                error_noty("{{ $errors->first()  }}");
            })
        @endif
    </script>
@stop