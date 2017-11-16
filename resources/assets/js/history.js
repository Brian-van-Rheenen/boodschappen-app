import Vue from 'vue';

import History from './components/history'

window.$ = window.jQuery = require('jquery');
new Vue({
    el: '#content',
    components: {
        History
    },
    data: {
        history: historyArray
    }
});