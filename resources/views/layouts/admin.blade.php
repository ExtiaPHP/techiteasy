<!DOCTYPE html>
<html>
    <head>
        <title>tech'IT easy - @yield('title')</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        {!! Html::style('assets/css/bootstrap.min.css') !!}
        {!! Html::style('assets/css/font-awesome.min.css') !!}
        {!! Html::style('assets/css/app.css') !!}
    </head>
    <body>
        @include('partials.header')

        <div class="container-fluid">
            @if (count($errors) > 0)
            <div class="alert alert-danger  alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
            @endif
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    @include('partials.sidebar', ['page' => $page])
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div class="admin-content">
                    @yield('content')
                    </div>
                </div>
            </div>
        </div>
        
        {!! Html::script('assets/js/jquery-2.1.4.min.js') !!}
        {!! Html::script('assets/js/bootstrap.min.js') !!}
        {!! Html::script('assets/js/admin.js') !!}
        {!! Html::script('assets/js/jquery.canvasjs.min.js') !!}
        {!! Html::script('assets/js/jquery.canvasjs.min.js') !!}

        @yield('script')
    </body>
</html>
