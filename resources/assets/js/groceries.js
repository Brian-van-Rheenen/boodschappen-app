import Vue from 'vue';

import Listgroupitemgroceries from './components/listGroupItemGroceries';
import Listgroupitemtrash from './components/listGroupItemTrash';
import Messagedelete from './components/messageDelete';

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
        description: '',
        quantity: 1,
        image: '',
        popularItems: [],
        ahItems: [],
        timer: '',
        ahGroupItem: false,
        confirmationMessage: false,
        trash: false
    },
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
        addItem() {

            if (this.description)
            {
                //Create AJAX post
                axios.post('/boodschappen', {
                    description: this.description,
                    quantity: this.quantity,
                    image: this.image
                }).then((res) => {

                    //Loop through all the groceries
                    for (var i in this.groceries)
                    {
                        //If the added grocery matches any in the array
                        if (this.groceries[i].description == res.data.description)
                        {
                            //Mark it as found and save the index
                            var found = true;
                            var index = i;

                            break;
                        }
                        else
                        {
                            //Mark it as not found
                            var found = false;
                        }
                    }

                    //If the added grocery is already inside the array
                    if (found)
                    {
                        //Update the quantity
                        this.groceries[index].quantity = res.data.quantity;

                        //Reset the form
                        this.resetForm();
                    }
                    else
                    {
                        //Push the added item into the groceries array
                        this.groceries.push(res.data);

                        //Reset the form
                        this.resetForm();
                    }
                });
            }
            else
            {
                return;
            }
        },
        getItems() {
            //Show the list
            this.ahGroupItem = true;

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
                    axios.get('/boodschappen/populair/' + this.description).then((res) => {

                        //Create a border around the box
                        $('.ahGroupItem').css('border', '1px solid #ccc');

                        //Get the data
                        var response = res.data;

                        //Loop through that data
                        for (var i in response)
                        {
                            //Push all the items inside the array
                            this.popularItems.push(response[i]);
                        }

                        //Set maximum shown items
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

                        try
                        {
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
                //Reset the image
                this.image = '';

                //Set a timer
                this.timer = window.setTimeout(function() {

                    //Get all the popular items
                    axios.get('/boodschappen/populair').then((res) => {

                        //Create a border around the box
                        $('.ahGroupItem').css('border', '1px solid #ccc');

                        //Get the data
                        var response = res.data;

                        //Loop through that data
                        for (var i in response)
                        {
                            //Push all the items inside the array
                            this.popularItems.push(response[i]);
                        }

                        //Set maximum shown items
                        this.popularItems.splice(5, response.length);
                    });
                }.bind(this), 500);
            }
        },
        resetForm() {
            //Reset the form
            this.description = '';
            this.image = '';
            this.quantity = 1;
            this.popularItems = [];
            this.ahItems = [];
            $('.ahGroupItem').css('border', 'none')
        },
        getValue(value, img) {
            //Set the description to the given value
            this.description = value;

            //Set the value of 'image' to the given value
            this.image = img;

            //Reset the array
            this.ahItems = [];

            //Hide the list
            this.ahGroupItem = false;
        }
    }
});