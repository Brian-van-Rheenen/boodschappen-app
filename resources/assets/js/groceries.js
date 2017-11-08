import Vue from 'vue';

import Listgroupitem from './components/listGroupItem'

new Vue({
    el: '#content',
    components: {
        Listgroupitem
    },
    data: {
        groceries: groceries,
        description: '',
        quantity: ''
    },
    methods: {
        addItem(e) {
            //Create AJAX post
            axios.post(e.target.action, this.$data).then((res) => {

                //Push the added item into the groceries array
                this.groceries.push(res.data);

                //Reset the form
                this.description = '';
                this.quantity = '';
            });
        },
        resetItems() {
            //Create AJAX post
            axios.post('/boodschappen/reset').then((res) => {

                //Clear the groceries array
                this.groceries = [];
            });
        }
    }
});