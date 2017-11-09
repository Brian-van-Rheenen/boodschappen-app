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
        ahItems: [],
        timer: ''
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

                //Clear the array
                this.ahItems = [];
                console.log("");
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
            //Clear the timeout
            window.clearTimeout(this.timer);

            //Reset the array
            this.ahItems = [];

            //If the user input is longer than 2 characters
            if (this.description.length > 2)
            {
                //Set a timer
                this.timer = window.setTimeout(function() {

                    //AJAX GET call to ah.nl
                    axios.get('https://www.ah.nl/service/rest/delegate?url=/zoeken?rq=' + this.description + '&searchType=product&_=1510216828382').then((res) => {

                        //Fetch the specific property
                        response = res.data['_embedded']['lanes'];

                        //Loop through that property
                        for (var i in response)
                        {
                            //Find a specific property inside the array
                            if (response[i].type == 'SearchLane')
                            {
                                //Store the used index
                                var index = i;
                            }
                        }

                        try {
                            //Fetch the specific property
                            var response = res.data['_embedded']['lanes'][index]['_embedded']['items'];

                            //Remove the last array object from the array
                            response.pop();

                            //Loop through the array
                            for (var k in response)
                            {
                                //Find a specific property inside the array that indicates that it is a grocery item
                                if (response[k].context == 'SearchAndBrowse')
                                {
                                    //Create a temporary array
                                    var item = {};

                                    //Save the fetched results into that array
                                    item['description'] = response[k]['_embedded']['product']['description'];
                                    item['image'] = response[k]['_embedded']['product']['images'][0]['link']['href'];

                                    //Push that array inside the ahItems array
                                    this.ahItems.push(item);
                                }
                            }
                        }
                        catch(err) {
                            //If it can't find any groceries, return
                            return;
                        }
                    });
                }.bind(this), 150);
            }
        },
        getValue(value, img) {
            //Set the description to the given value
            this.description = value;

            //Set the value of 'image' to the given value
            this.image = img;

            //Reset the array
            this.ahItems = [];
        }
    }
});