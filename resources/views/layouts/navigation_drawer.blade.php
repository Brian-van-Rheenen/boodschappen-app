<header class="layout-header">
    @if(!$home)
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
        @if(Auth::check() && Auth::user()->isAdmin())
            <a class="drawer-list-item" href="/gebruikers">
                <i class="material-icons nav-icons">supervisor_account</i><span>Gebruikers beheren</span>
            </a>
        @endif
        <a class="drawer-list-item" href="/geschiedenis">
            <i class="material-icons nav-icons">history</i><span>Geschiedenis</span>
        </a>
        <a class="drawer-list-item" href="/instellingen">
            <i class="material-icons nav-icons">settings</i><span>Instellingen</span>
        </a>
    </nav>
    <nav class="drawer-navigation">
        <a class="drawer-list-item drawer-icon-right" href="/logout">
            <span>Uitloggen</span><i class="material-icons nav-icons">power_settings_new</i>
        </a>
    </nav>
</div>