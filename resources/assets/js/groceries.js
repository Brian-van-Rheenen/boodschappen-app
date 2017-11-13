import Vue from 'vue';

import Listgroupitem from './components/listGroupItem';
import Listgroupitemtrash from './components/listGroupItemTrash';

window.app = new Vue({
    el: '#content',
    components: {
        Listgroupitem,
        Listgroupitemtrash
    },
    data: {
        groceries: groceries,
        description: '',
        quantity: 1,
        image: '',
        popularItems: [],
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
                this.resetForm();

                //Clear the array
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
            //Show the list
            $('.ahGroupItem').show();

            //Clear the timeout
            window.clearTimeout(this.timer);

            //Reset the arrays
            this.popularItems = [];
            this.ahItems = [];

            //If the user input is longer than 2 characters
            if (this.description.length > 0)
            {
                //Set a timer
                this.timer = window.setTimeout(function() {

                    //Get all the popular items
                    axios.get('/boodschappen/popular/' + this.description).then((res) => {

                        //Get the data
                        var response = res.data;

                        //Loop through that data
                        for (var i in response)
                        {
                            //Push all the items inside the array
                            this.popularItems.push(response[i]);
                        }
                        this.popularItems.splice(5, response.length);
                    });

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
                                    item['image'] = response[k]['_embedded']['product']['images'][3]['link']['href'];

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
                }.bind(this), 500);
            }
            else
            {
                //Set a timer
                this.timer = window.setTimeout(function() {
                    //Get all the popular items
                    axios.get('/boodschappen/popular').then((res) => {

                        //Get the data
                        var response = res.data;

                        //Loop through that data
                        for (var i in response)
                        {
                            //Push all the items inside the array
                            this.popularItems.push(response[i]);
                        }
                        this.popularItems.splice(5, response.length);
                    });
                }.bind(this), 500);
            }
        },
        resetForm() {
            this.description = '';
            this.image = '';
            this.quantity = 1;
            this.popularItems = [];
            this.ahItems = [];
        },
        getValue(value, img) {
            //Set the description to the given value
            this.description = value;

            //Set the value of 'image' to the given value
            this.image = img;

            //Reset the array
            this.ahItems = [];

            //Hide the list
            $('.ahGroupItem').hide();
        }
    }
});