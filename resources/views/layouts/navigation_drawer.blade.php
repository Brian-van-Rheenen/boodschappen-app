<header class="layout-header">
    @if($history || $user)
        <button class="header-drawer-toggle">
            <a href="/boodschappen"><i class="material-icons">arrow_back</i></a>
        </button>
    @else
        <button class="header-drawer-toggle">
            <i class="material-icons">menu</i>
        </button>
    @endif
    <span class="header-title default">{{ $header }}</span>
</header>

<div class="layout-dim"></div>
<div class="layout-drawer">
    <div class="drawer-header drawer-header-cover">
        <div class="drawer-user">
            <div class="drawer-meta">
                <span class="drawer-name">{{ Auth::user()->getName() }}</span>
                <span class="drawer-email">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </div>
    <nav class="drawer-navigation drawer-border">
        @if($history || $user)
            <a class="drawer-list-item" href="/boodschappen">
                <i class="material-icons nav-icons">local_grocery_store</i><span>Boodschappen lijst</span>
            </a>
        @endif
        @if(Auth::check() && Auth::user()->isAdmin())
            @if (!$user)
                <a class="drawer-list-item" href="/users">
                    <i class="material-icons nav-icons">supervisor_account</i><span>Personen beheren</span>
                </a>
            @endif
        @endif
        @if (!$history)
            <a class="drawer-list-item" href="/history">
                <i class="material-icons nav-icons">history</i><span>Geschiedenis</span>
            </a>
        @endif
    </nav>
    <nav class="drawer-navigation">
        <a class="drawer-list-item drawer-icon-right" href="/logout">
            <span>Uitloggen</span><i class="material-icons nav-icons">power_settings_new</i>
        </a>
    </nav>
</div>