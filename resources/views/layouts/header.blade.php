<section class="header">
    <div class="header-container">
        <span>Boodschappen lijst</span>
        <a href="/logout"><i class="fa fa-sign-out icons" aria-hidden="true"></i></a>
        @if(Auth::check() && Auth::user()->isAdmin())
            <i class="fa fa-history icons" aria-hidden="true"></i>
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