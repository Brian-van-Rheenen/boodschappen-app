<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "settings", 'title' => "Boodschappen lijstje | Instellingen"])
<body>
    <div id="content">
        @include('layouts.navigation_drawer', ['header' => "Instellingen", 'home' => false])

        <section class="body">
            <h3 class="headerTitle">Wachtwoord wijzigen</h3>

            <form class="user-form" method="POST" action="/instellingen/{{ Auth::id() }}/wachtwoord" @submit.prevent="update">

                <div class="group">
                    <input type="password" name="password" v-model="password" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Nieuw Wachtwoord</label>
                </div>

                <div class="group">
                    <input type="password" name="password_confirmation" v-model="password_confirmation" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Herhaal wachtwoord</label>
                </div>

                <input type="submit" class="button" value="Wachtwoord veranderen">
            </form>

            <errors></errors>
        </section>
    </div>
    <script src="{{ mix('js/settings.js') }}"></script>
</body>
</html>