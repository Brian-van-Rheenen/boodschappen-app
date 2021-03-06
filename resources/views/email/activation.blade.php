<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "verify", 'title' => "Boodschappen lijstje | Verifieer"])
<body>
    <header class="layout-header"><span>Verifieer je account</span>
        <button class="header-drawer-toggle">
            <a href="/"><i class="material-icons">arrow_back</i></a>
        </button>
    </header>

    <section class="body">
        <p>Vul hieronder je wachtwoord in.</p>

        <form class="user-form-add" id="user-form-add" method="POST" action="/verifieer/update/{!! $confirmation_code !!}" @submit.prevent="add">

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

            <input type="submit" class="button" value="Account aanmaken">
        </form>

        <errors></errors>
    </section>
    <script src="{{ mix('js/verify.js') }}"></script>
</body>
</html>