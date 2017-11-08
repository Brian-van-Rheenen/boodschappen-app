import Vue from 'vue';

import History from './components/history'

new Vue({
    el: '#content',
    components: {
        History
    },
    data: {
        history: historyArray
    }
});