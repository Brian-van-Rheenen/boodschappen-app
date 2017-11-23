import Vue from 'vue';

import Listgroupitemusers from './components/listGroupItemUsers';
import Errors from './components/errors';

window.$ = window.jQuery = require('jquery');
window.axios = window.axios = require('axios');

window.app = new Vue({
    el: '#content',
    components: {
        Listgroupitemusers,
        Errors
    },
    data: {
        users: users,
        email: '',
        role: '',
        password: '',
        password_confirmation: '',
        flashMessages: [],
        confirmationMessage: false
    },
    methods: {
        add(e) {

            this.resetFlashMessages();

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                this.flashMessages.push(res.data[1]);

                if (res.data[0] != 'duplicate')
                {
                    //Push the user in the array
                    this.users.push(res.data[0]);
                }

            //If there are any errors
            }).catch(({ response }) => {
                var errors = response.data.errors;

                //Loop through all the errors
                for (var i in errors)
                {
                    for (var j in errors[i])
                    {
                        //Insert them into the array
                        var error = [];
                        error['description'] = errors[i][j];
                        error['type'] = 'error'
                        this.flashMessages.push(error);
                    }
                };
            });
        },
        update(e) {

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                //Loop through all the users
                for (var i in this.users)
                {
                    //If the added users matches any in the array
                    if (this.users[i].id == res.data.id)
                    {
                        this.$set(this.users, i, res.data);
                        this.email = '';
                        this.role = '';

                        //Show the correct form
                        $('.user-form-add').show();
                        $('.user-form-edit').hide();
                    }
                }
            });
        },
        resetInput() {
            this.email = '';
            this.role = '';
            this.password = '';
            this.password_confirmation = '';
        },
        resetFlashMessages() {
            this.flashMessages = [];
        }
    }
});