<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "verify", 'title' => "Boodschappen lijstje | Wachtwoord Wijzigen"])
<body>
    <header class="layout-header"><span>Wachtwoord veranderen</span>
        <button class="header-drawer-toggle">
            <a href="/"><i class="material-icons">arrow_back</i></a>
        </button>
    </header>

    <section class="body">
        <p>Vul hieronder een nieuw wachtwoord in.</p>

        <form class="user-form-add" id="user-form-add" method="POST" action="/wachtwoord-vergeten/update/{!! $password_reset !!}" @submit.prevent="update">

            <div class="group">
                <input type="password" name="password" v-model="password" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Wachtwoord</label>
            </div>

            <div class="group">
                <input type="password" name="password_confirmation" v-model="password_confirmation" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Herhaal wachtwoord</label>
            </div>

            <input type="submit" class="button" value="Wachtwoord wijzigen">
        </form>

        <errors></errors>
        <span style="display: none;" v-bind:style="{'display': succesful}">Klik <a href="/boodschappen">hier</a> om verder te gaan.</span>
    </section>
    <script src="{{ mix('js/password_reset.js') }}"></script>
</body>
</html>