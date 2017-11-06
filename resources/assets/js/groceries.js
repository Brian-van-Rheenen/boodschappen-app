import Vue from 'vue';

import Message from './components/message';
import Additem from './components/addItem';

new Vue({
    el: '#content',
    components: {
        Message,
        Additem
    },
    data: {
        description: '',
        quantity: ''
    },
    methods: {
        onSubmit(e) {
            axios.post(e.target.action, this.$data).then(this.onSuccess);
        },

        onSuccess(response) {
            this.description = '';
            this.quantity = '';
        }
    }
});