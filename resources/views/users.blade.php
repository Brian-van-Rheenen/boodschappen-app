<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "users", 'title' => "Boodschappen lijstje | Gebruikers"])
<body>
    <div id="content">
        @include('layouts.header', ['header' => "Gebruiker toevoegen", 'history' => false, 'user' => true])

        <section class="body">
            <h3 class="title">Een nieuwe gebruiker toevoegen</h3>

            <form class="user-form" id="user-form" method="POST" action="/users/toevoegen">
                {{ csrf_field() }}

                <div class="group" style="margin-bottom: 30px">
                    <input type="text" name="email" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Emailadres</label>
                </div>

                <div class="group">
                    <label class="label-role">Rol:</label>
                    <select class="role" name="role" form="user-form">
                        <option value="normal">Normaal</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="group">
                    <input type="password" name="password" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Wachtwoord</label>
                </div>

                <div class="group">
                    <input type="password" name="password_confirmation" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Herhaal wachtwoord</label>
                </div>

                <input type="submit" class="button" value="Account aanmaken">

                @if ($flash = session('message'))
                    <div id="flash-message" class="alert alert-success" role="alert">
                        {{ $flash }}
                    </div>
                @elseif ($flash = session('error'))
                    <div id="flash-message" class="alert alert-danger" role="alert">
                        {{ $flash }}
                    </div>
                @endif
                @include('layouts.errors')
            </form>
        </section>
    </div>
</body>
</html>