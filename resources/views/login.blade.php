<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "login", 'title' => "Boodschappen lijstje | Login"])
<body>
    <section class="header">
        <img alt="Moodles internetbureau Rotterdam" src="images/logo.png">
    </section>

    <section class="body">
        <img alt="Inlog sleutel" src="images/key.svg" id="key">
        <form class="login-form" method="POST" action="/login">
            {{ csrf_field() }}

            <div class="group">
                <input type="text" name="email" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Emailadres</label>
            </div>

            <div class="group">
                <input type="password" name="password" id="password" autocomplete="new-password" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Wachtwoord</label>
            </div>

            <input type="submit" class="button" value="Inloggen">
            <div><a class="forgot" href="/wachtwoord-vergeten">Wachtwoord vergeten?</a></div>

            @if (count($errors))
                <div id="flash-message" class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
        </form>
    </section>
</body>
</html>