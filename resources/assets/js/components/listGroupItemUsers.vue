<template>
    <div class="userContainer">
        <li class="list-group-item" v-for="user in users">
            <span class="user">{{ user.email }}</span>
            <i class="material-icons edit" v-on:click="edit(user)">mode_edit</i>
            <i class="material-icons trash" v-bind:class="{'disabled': user.email == this.activeUser.email}" v-on:click="trash(user)">delete</i>
        </li>
        <messageDelete title="Verwijder?" message="Weet je zeker dat je dit account wilt verwijderen?" action="verwijdert" remaining="het permanent." on-click="trash" button-span="Verwijderen" :users="users" :user="focusedUser"></messageDelete>
    </div>
</template>
<script>
    import Messagedelete from './messageDelete';
    export default {
        components: {
            'messageDelete': Messagedelete
        },
        name: 'listGroupItemUsers',
        props: ['users'],
        data() {
            return {
                focusedUser: null
            }
        },
        methods: {
            edit(user) {
                this.$root.resetFlashMessages();

                //If the users are the same
                if (user.email == activeUser.email)
                {
                    $( ".user-form-edit > .group:has(select)" ).hide();
                }
                else
                {
                    $( ".user-form-edit > .group:has(select)" ).show();
                }

                $('.user-form-add').hide();
                $('.user-form-edit').show();

                //Set the values
                $('.spanEmail').text(user.email);
                this.$root.email = user.email;
                this.$root.role = user.role;

                //Change the post url
                $('.user-form-edit').attr('action', '/gebruikers/' + user.id + '/update');
            },
            trash(user) {

                //If the users are the same
                if (user.email == activeUser.email)
                {
                    //Don't do anything
                    return;
                }

                this.focusedUser = user;

                app.confirmationMessage = true;
            }
        }
    }
</script>