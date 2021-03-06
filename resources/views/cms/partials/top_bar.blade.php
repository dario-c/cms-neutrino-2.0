<div class="top-bar row no-row-padding">
    <div class="col-sm-3 col-xs-7"> 
        <img class="logo" src="{{ asset('assets/cms/images/logo-caviar.png') }}" alt="CAVIAR" />
    </div>
    @unless (Auth::guest())
    <div class="col-sm-7 hidden-xs text-right greeting">
        Hi, {{ Auth::user()->name }}
    </div>
    <div class="col-sm-2 col-xs-5">
        <a href="/auth/logout/" class="btn btn-large btn-danger btn-logout no-border-radius">Logout</a>
    </div>  
    @endunless
</div>