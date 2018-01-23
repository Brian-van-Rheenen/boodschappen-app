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
        email: '',
        password: '',
        password_confirmation: '',
        flashMessages: [],
        succesful: 'none'
    },
    methods: {
        request(e) {

            this.resetFlashMessages();

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                //If succesful
                if (res.data == 'success')
                {
                    //Insert them into the array
                    var success = [];
                    success['description'] = 'Er is een e-mail met daarin een link verstuurd om het wachtwoord te wijzigen.';
                    success['type'] = 'success'
                    this.flashMessages.push(success);
                    $('.button').remove();
                }
                //Else
                else
                {
                    //Insert them into the array
                    var error = [];
                    error['description'] = 'Er is iets niet gelukt. Kijk of het ingevoerd e-mail adres klopt en of die gekoppeld is aan een account.';
                    error['type'] = 'error'
                    this.flashMessages.push(error);
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

            this.resetFlashMessages();

            //Change the user data
            axios.post(e.target.action, this.$data).then((res) => {

                //If succesful
                if (res.data == 'success')
                {
                    //Insert them into the array
                    var success = [];
                    success['description'] = 'Wachtwoord succesvol gewijzigd.';
                    success['type'] = 'success'
                    this.flashMessages.push(success);

                    this.succesful = 'block';
                }
                //Else
                else
                {
                    //Insert them into the array
                    var error = [];
                    error['description'] = 'Wachtwoord wijzigen niet gelukt. Check of alles klopt en dat de link die in de e-mail zit nog klopt.';
                    error['type'] = 'error'
                    this.flashMessages.push(error);

                    this.succesful = 'none';
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

                        this.succesful = 'none';
                    }
                };
            });
        },
        resetFlashMessages() {
            this.flashMessages = [];
            this.succesful = 'none';
        }
    }
});