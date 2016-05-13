<!DOCTYPE html>
<html>
    <head>
        <title>tech'IT easy - @yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        {!! Html::style('assets/css/bootstrap.min.css') !!}
        {!! Html::style('assets/css/font-awesome.min.css') !!}
        {!! Html::style('assets/css/app.css') !!}
    </head>
    <body>
        @include('partials.header')

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            @yield('content')
        </div>

        @include('partials.footer')
        
        {!! Html::script('assets/js/jquery-2.1.4.min.js') !!}
        {!! Html::script('assets/js/bootstrap.min.js') !!}
        {!! Html::script('assets/noty-2.3.8/js/noty/packaged/jquery.noty.packaged.min.js') !!}
        {!! Html::script('assets/noty-2.3.8/js/noty/themes/bootstrap.js') !!}
        {!! Html::script('assets/js/noty.js') !!}


        @yield('script')

    </body>
</html>
