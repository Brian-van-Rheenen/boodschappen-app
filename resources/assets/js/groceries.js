import Vue from 'vue';

import Listgroupitemgroceries from './components/listGroupItemGroceries';
import Listgroupitemtrash from './components/listGroupItemTrash';
import Messagedelete from './components/messageDelete';

import groceriesDatabase from './mixin/groceriesDatabase';

window.$ = window.jQuery = require('jquery');
window.axios = window.axios = require('axios');

window.app = new Vue({
    el: '#content',
    components: {
        Listgroupitemgroceries,
        Listgroupitemtrash,
        Messagedelete
    },
    data: {
        groceries: groceries,
        id: '',
        description: '',
        quantity: 1,
        priceWas: 0,
        priceNow: 0,
        discount: '',
        image: '',
        popularItems: [],
        ahItems: [],
        timer: '',
        confirmationMessage: false,
        trash: false
    },
    mixins: [groceriesDatabase],
    computed: {
        trashDisplay() {
            if (this.trash)
            {
                return 'flex';
            }
            else
            {
                return 'none';
            }
        }
    },
    methods: {
        resetForm() {
            //Reset the form
            this.id = '';
            this.description = '';
            this.image = '';
            this.quantity = 1;
            this.priceWas = 0;
            this.priceNow = 0;
            this.discount = '';
            this.popularItems = [];
            this.ahItems = [];
        },
        getValue(id, value, img, priceWas, priceNow, discount) {

            //Set id
            this.id = id;

            //Set the description to the given value
            this.description = value;

            //Set the prices
            this.priceWas = priceWas;
            this.priceNow = priceNow;

            //Set the discount label
            this.discount = discount;

            //Set the value of 'image' to the given value
            this.image = img;

            //Reset the array
            this.popularItems = [];
            this.ahItems = [];
        }
    }
});