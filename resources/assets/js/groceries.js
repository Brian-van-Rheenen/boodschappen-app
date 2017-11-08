import Vue from 'vue';

import Listgroupitem from './components/listGroupItem'
import Message from './components/message';

new Vue({
    el: '#content',
    components: {
        Listgroupitem,
        Message
    },
    data: {
        groceries: groceries,
        description: '',
        quantity: ''
    },
    methods: {
        addItem(e) {
            axios.post(e.target.action, this.$data).then((res) => {
                this.groceries.push(res.data);
                this.description = '';
                this.quantity = '';
            });
        },
        resetItems() {
            axios.post('/boodschappen/reset').then((res) => {
                this.groceries = [];
            });
        }
    }
});