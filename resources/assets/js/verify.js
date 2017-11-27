import Vue from 'vue';

import Errors from './components/errors';

window.$ = window.jQuery = require('jquery');
window.axios = window.axios = require('axios');

window.app = new Vue({
    el: '.body',
    components: {
        Errors
    },
    data: {
        password: '',
        password_confirmation: '',
        flashMessages: []
    },
    methods: {
        add(e) {

            this.resetFlashMessages();

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                //If succesful
                if (res.data == 'success')
                {
                    //Relocate to /boodschappen
                    window.location.replace("/boodschappen");
                }
                //Else
                else
                {
                    //Relocate to 404 not found
                    window.location.replace("/404");
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
        resetFlashMessages() {
            this.flashMessages = [];
        }
    }
});