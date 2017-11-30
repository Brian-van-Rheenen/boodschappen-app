import Vue from 'vue';

import Schedule from './components/schedule';

window.$ = window.jQuery = require('jquery');
window.axios = window.axios = require('axios');

window.app = new Vue({
    el: '#content',
    components: {
        Schedule
    },
    data: {
        schedule: schedule,
        popularItems: [],
        ahItems: [],
    }
});