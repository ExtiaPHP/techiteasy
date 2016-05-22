<div id="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('welcome') }}"><span class="logo-1">tech</span><span class="logo-2">'</span><span class="logo-3">IT</span> <span class="logo-4">easy</span></a>
            </div>



            @if(Auth::check())
                <div class="collapse navbar-collapse navbar-right">
                    <a href="" class="btn btn-default navbar-btn"><span>{{ Auth::user()->login }}</span> <i class="fa fa-unlock-alt"></i></a>
                    <a href="{{ url('auth/logout') }}"class="btn btn-default navbar-btn "><i class="fa fa-power-off" title="Déconnection"></i></a>
                </div>
            @else
                <div class="collapse navbar-collapse navbar-right">
                    <a href="{{ route('login') }}"class="btn btn-default navbar-btn"><span>{!! trans('content.header_admin') !!}</span> <i class="fa fa-lock"></i></a>
                </div>
            @endif

            <div class="collapse navbar-collapse navbar-right padding_top_8" style="padding-right:10px">
                <a href="/language?lang=en" >{!! Html::image('assets/img/angleterre.jpg', 'england', ['width' => '48px', 'height' => '34px']) !!}</a>
            </div>

            <div class="collapse navbar-collapse navbar-right padding_top_8" style="padding-right:10px">
                <a href="/language?lang=fr" >{!! Html::image('assets/img/france.jpg', 'france', ['width' => '48px', 'height' => '34px']) !!}</a>
            </div>
        </div>
        <div class="lineTotal" id="lineTotal" style="width:0px"></div>

    </nav>
</div>