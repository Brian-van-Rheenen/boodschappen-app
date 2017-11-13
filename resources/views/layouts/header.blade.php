<section class="header">
    <div class="header-container">
        @if($history || $user)
            <a href="/boodschappen"><i class="fa fa-angle-left icons" aria-hidden="true"></i></a>
        @endif
        <span>{{ $header }}</span>
        @if(Auth::check() && Auth::user()->isAdmin())
            @if (!$user)
                <a href="/users"><i class="fa fa-user-plus icons" aria-hidden="true"></i></a>
            @endif
            @if (!$history)
                <a href="/history"><i class="fa fa-history icons" aria-hidden="true"></i></a>
            @endif
        @endif
        <a href="/logout"><i class="fa fa-sign-out icons" aria-hidden="true"></i></a>
    </div>
</section>