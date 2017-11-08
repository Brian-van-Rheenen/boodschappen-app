<section class="header">
    <div class="header-container">
        @if($history)
            <a href="/boodschappen"><i class="fa fa-angle-left icons" aria-hidden="true"></i></a>
        @endif
        <span>{{ $header }}</span>
        <a href="/logout"><i class="fa fa-sign-out icons" aria-hidden="true"></i></a>
        @if(Auth::check() && Auth::user()->isAdmin() && !$history)
            <a href="/history"><i class="fa fa-history icons" aria-hidden="true"></i></a>
        @endif
    </div>

    <!--
    <div class="items">
        <div class="addItem">
            <img src="images/plus.png" class="plus">
            <input type="text" name="item" class="item">
        </div>
    </div>
    -->
</section>