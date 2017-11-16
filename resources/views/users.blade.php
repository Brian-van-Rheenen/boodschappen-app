<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "users", 'title' => "Boodschappen lijstje | Gebruikers"])
<body>
    <div id="content">
        @include('layouts.header', ['header' => "Gebruiker toevoegen", 'history' => false, 'user' => true])

        <section class="body">
            <label class="title">Een nieuwe gebruiker toevoegen</label>

            <form class="user-form" id="user-form" method="POST" action="/users/toevoegen">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Emailadres:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Rol:</label>
                    <select class="form-control" name="role" form="user-form">
                        <option value="normal">Normaal</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Wachtwoord:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Herhaal wachtwoord:</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Account aanmaken">
                </div>

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