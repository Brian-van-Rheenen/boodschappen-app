<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "users", 'title' => "Boodschappen lijstje | Gebruikers"])
<body>
    <div id="content">
        @include('layouts.header', ['header' => "Gebruiker toevoegen", 'history' => false, 'user' => true])

        <section class="body">
            <h3 class="headerTitle">Gebruikers wijzigen</h3>

            <listGroupItemUsers :users="users"></listGroupItemUsers>

            <errors></errors>

            <!-- Add form -->

            <form class="user-form-add" id="user-form-add" method="POST" action="/users/toevoegen" @submit.prevent="add">

                <div class="group">
                    <input type="text" name="email" v-model="email" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Emailadres</label>
                </div>

                <div class="group">
                    <select class="role" name="role" v-model="role" form="user-form-add" required>
                        <option value="normal">Normaal</option>
                        <option value="admin">Admin</option>
                    </select>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-role">Rol:</label>
                </div>

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

            <!-- Update form -->

            <form class="user-form-edit" id="user-form-edit" method="POST" action="/users/update" @submit.prevent="update">

                <i class="material-icons swap">swap_horiz</i>

                <div class="group account">
                    <h4>Aanpassen aan:</h4>
                    <span class="spanEmail"></span>
                </div>

                <div class="group">
                    <input type="text" name="email" id="email" v-model="email" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Emailadres</label>
                </div>

                <div class="group">
                    <select class="role" name="role" id="role" v-model="role" form="user-form-edit" required>
                        <option value="normal">Normaal</option>
                        <option value="admin">Admin</option>
                    </select>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label class="label-role">Rol:</label>
                </div>

                <input type="submit" class="button" value="Opslaan">

                @include('layouts.errors')
            </form>
        </section>
    </div>
    <script>
        var activeUser = {!! $user !!};
        var users = {!! json_encode($users) !!};
    </script>
    <script src="{{ mix('js/users.js') }}"></script>
    <script type="text/javascript">
        $('.swap').click(function(){
            $('.user-form-add').show();
            $('.user-form-edit').hide();

            app.$root.resetInput();
        });

        $('.confirmationButton').click(function(){
            $('.shadow').hide();
            $('.messageContainer').hide();
            $('.resetItems').hide();
        });
    </script>
</body>
</html>