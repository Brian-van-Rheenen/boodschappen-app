import Vue from 'vue';

import Schedule from './components/schedule';

window.app = new Vue({
    el: '#content',
    components: {
        Schedule
    },
    data: {
        schedule: schedule
    }
});