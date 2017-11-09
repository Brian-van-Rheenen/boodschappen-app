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
        quantity: '',
        image: '',
        ahItems: []
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
                this.ahItems = [];
            });
        },
        resetItems() {
            //Create AJAX post
            axios.post('/boodschappen/reset').then((res) => {

                //Clear the groceries array
                this.groceries = [];
            });
        },
        getItems() {
            this.ahItems = [];

            if (this.description.length > 2)
            {
                axios.get('https://www.ah.nl/service/rest/delegate?url=/zoeken?rq=' + this.description + '&searchType=product&_=1510216828382').then((res) => {

                    var response = res.data['_embedded']['lanes'][6]['_embedded']['items'];
                    response.pop();

                    for (var k in response)
                    {
                        //console.log(response[k]['_embedded']['product']['description'] ,k);
                        var item = {};
                        item['description'] = response[k]['_embedded']['product']['description'];
                        item['image'] = response[k]['_embedded']['product']['images'][0]['link']['href'];
                        this.ahItems.push(item);
                    }
                });
            }
        },
        getValue(value, img) {
            this.description = value;
            $('.hiddenImg').val(img);
            this.image = img;
            this.ahItems = [];
        }
    }
});