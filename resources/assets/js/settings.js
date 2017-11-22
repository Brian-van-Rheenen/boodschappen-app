import Vue from 'vue';

import Errors from './components/errors';

window.axios = window.axios = require('axios');

window.app = new Vue({
    el: '#content',
    components: {
        Errors
    },
    data: {
        password: '',
        password_confirmation: '',
        flashMessages: []
    },
    methods: {
        update(e) {

            //Reset flash messages
            this.resetFlashMessages();

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                //Show a flash message
                this.flashMessages.push(res.data);
                this.resetInput();

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
        resetInput() {
            this.password = '';
            this.password_confirmation = '';
        },
        resetFlashMessages() {
            this.flashMessages = [];
        }
    }
});