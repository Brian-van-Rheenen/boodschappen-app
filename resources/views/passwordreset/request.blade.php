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
        <p>Vul hieronder het emailadres van het account in.</p>

        <form class="user-form-add" id="user-form-add" method="POST" action="/wachtwoord-vergeten/update" @submit.prevent="request">

            <div class="group">
                <input type="text" name="email" v-model="email" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Emailadres</label>
            </div>

            <input type="submit" class="button" value="Wachtwoord veranderen">
        </form>

        <errors></errors>
    </section>
    <script src="{{ mix('js/password_reset.js') }}"></script>
</body>
</html>