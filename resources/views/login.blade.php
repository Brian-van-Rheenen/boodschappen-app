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

            <div class="form-group">
                <label>Emailadres:</label><br>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Wachtwoord:</label><br>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Inloggen">
            </div>

            @include('layouts.errors')
        </form>
    </section>
</body>
</html>