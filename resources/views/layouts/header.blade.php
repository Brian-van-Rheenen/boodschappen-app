<section class="header">
    <div class="header-container">
        @if($history || $user)
            <a href="/boodschappen"><i class="material-icons icons arrow_back">arrow_back</i></a>
        @endif
        <span>{{ $header }}</span>
        @if(Auth::check() && Auth::user()->isAdmin())
            @if (!$user)
                <a href="/users"><i class="material-icons icons">person_add</i></a>
            @endif
            @if (!$history)
                <a href="/history"><i class="material-icons icons">history</i></a>
            @endif
        @endif
        <a href="/logout"><i class="material-icons icons">power_settings_new</i></a>
    </div>
</section>