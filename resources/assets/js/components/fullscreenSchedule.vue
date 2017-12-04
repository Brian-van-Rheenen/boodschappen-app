<template>
    <div class="disableScroll">
        <transition name="slideUp">
            <div class="dialogContainer" v-if="showDialog">
                <header class="layout-header">
                    <button class="header-drawer-toggle">
                        <i class="material-icons" v-on:click="dialog(false)">clear</i>
                    </button>
                    <span class="header-title default">Boodschappen Toevoegen</span>
                </header>

                <section class="dialogBody">
                    <div class="group">
                        <label class="label-role">Kies een dag:</label>
                        <div class="groupSelect">
                            <select class="days" name="days" v-model="selectedDate" required>
                                <option v-for="day in days" v-bind:value="day.name" v-text="day.name"></option>
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div>
                    </div>

                    <div class="schedule">
                        <div class="day" v-bind:class="{ scheduledDay: selectedDate }">
                            <ul class="schedule-group">
                                <template v-if="selectedDate">
                                    <template v-for="day in days" v-if="day.name == selectedDate">
                                        <template v-if="day.data.length">
                                            <template v-for="data in day.data">
                                                <li class="schedule-group-item">
                                                    <div class="container">
                                                        <span class="hoeveelheid">{{data.quantity }}x</span>
                                                        <img :src="data.image" v-if="data.image">
                                                    </div>
                                                    <div class="items">{{ data.description }}</div>
                                                    <div class="trashContainer">
                                                        <i class="material-icons trash" v-on:click="trash(data)">delete</i>
                                                    </div>
                                                </li>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <div class="items" style="padding: 14px 0px 14px 0px;">Geen producten gevonden</div>
                                        </template>
                                    </template>
                                </template>
                                <template v-else>
                                    <div class="items" style="padding-top: 14px;">Geen dag gekozen</div>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <form class="addNewItem">
                        <ul class="list-group ahGroupItem" v-if="ahGroupItem">
                            <div class="popularItems" v-if="this.$root.popularItems.length">
                                <li class="list-group-item ahItem"><h4>Top 5 populairste items:</h4></li>
                                <li class="list-group-item ahItem" v-for="item in this.$root.popularItems" @click="getValue(item.description,item.image,item.priceWas,item.priceNow)">
                                    <div class="container">
                                        <img :src="item.image" v-if="item.image">
                                    </div>
                                    <div class="items">{{ item.description }}</div>
                                    <span class="ahPrice" v-if="item.image"><span class="priceWas" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span></span>
                                </li>
                            </div>
                            <div class="ahItems" v-if="this.$root.ahItems.length">
                                <li class="list-group-item ahItem"><h4>Suggesties:</h4></li>
                                <li class="list-group-item ahItem" v-for="item in this.$root.ahItems" @click="getValue(item.description,item.image,item.priceWas,item.priceNow)">
                                    <div class="container">
                                        <img :src="item.image" v-if="item.image">
                                    </div>
                                    <div class="items">{{ item.description }}</div>
                                    <span class="ahPrice" v-if="item.image"><span class="priceWas" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span></span>
                                </li>
                            </div>
                        </ul>

                        <div class="itemWrapper">
                            <div class="inputItem">
                                <input type="hidden" class="hiddenImg" name="image" v-model="image">
                                <input type="text" class="newItem" name="description" autocomplete="off" v-model="description" v-on:keyup="getItems" placeholder="Voeg toe" @click="getItems" required></input>
                                <div class="clearBox"><i class="material-icons clear" v-on:click="clear">clear</i></div>
                            </div>

                            <div class="inputQuantity">
                                <input type="number" class="quantity" name="quantity" autocomplete="off" v-model="quantity" required></input>
                                <button type="button" class="btn btn-success addItemButton" @click="quantity += 1"><i class="material-icons">add</i></button>
                            </div>
                        </div>
                        <input type="button" class="button" value="Boodschap toevoegen" v-bind:class="{ disabled: disabled }" v-on:click="addItem" :disabled="disabled">
                    </form>
                </section>
            </div>
        </transition>
    </div>
</template>
<script>
    export default {
        name: 'fullscreenSchedule',
        props: ['schedule', 'show'],
        data() {
            return {
                description: '',
                quantity: 1,
                priceWas: 0,
                priceNow: 0,
                image: '',
                timer: '',
                ahGroupItem: false,
                showDialog: false,
                selectedDate: '',
                disabled: true
            }
        },
        watch: {
            show() {
                this.showDialog = this.show;
            },
            selectedDate() {
                if (this.selectedDate != '')
                {
                    this.disabled = false;
                }
                else
                {
                    this.disabled = true;
                }
            }
        },
        computed: {
            fullscreen: {
                get: function() {
                    return this.show;
                },

                set: function(bool) {
                    this.showDialog = bool;
                    app.$children[0].fullscreen = bool;

                    if (bool == false)
                    {
                        this.description = '';
                        this.quantity = 1;
                        this.priceWas = 0,
                        this.priceNow = 0,
                        this.image = '';
                        this.selectedDate = '';
                        this.disabled = true;
                    }
                }
            },
            days() {
                return [
                    { name: 'maandag', data: this.schedule.filter(name => name.day == 'maandag') },
                    { name: 'dinsdag', data: this.schedule.filter(name => name.day == 'dinsdag') },
                    { name: 'woensdag', data: this.schedule.filter(name => name.day == 'woensdag') },
                    { name: 'donderdag', data: this.schedule.filter(name => name.day == 'donderdag') },
                    { name: 'vrijdag', data: this.schedule.filter(name => name.day == 'vrijdag') }
                ];
            }
        },
        methods: {
            dialog(bool) {
                this.fullscreen = false;

                $("body").css("overflow", "auto");
                $(".disableScroll").css('top', '');
            },
            trash(item) {
                //Find the index of this scheduled grocery item
                var index = this.schedule.findIndex(x => x.id==item.id);

                //Remove the item from the array
                this.schedule.splice(index, 1);

                //Remove the scheduled grocery from the database
                axios.post(`/planning/${item.id}/delete`, {
                    id: item.id
                });
            },
            clear() {
                $('.clear').addClass('pulse');
                this.resetForm();

                $('.clear').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e)
                {
                    $('.clear').removeClass('pulse');
                });
            },
            addItem() {
                if (this.description)
                {
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
                                if (response[k].context == 'SearchAndBrowse' && response[k]['_embedded']['product'].description.replace(/[^\x00-\x7F]/g, "") == this.description)
                                {
                                    //Save the fetched results into that array
                                    this.priceNow = response[k]['_embedded']['product']['priceLabel']['now'];
                                    this.priceWas = response[k]['_embedded']['product']['priceLabel']['was'];
                                }
                            }


                            //Create AJAX post
                            axios.post('/planning', {
                                day: this.selectedDate,
                                description: this.description,
                                quantity: this.quantity,
                                priceWas: this.priceWas,
                                priceNow: this.priceNow,
                                image: this.image
                            }).then((res) => {

                                //Loop through all the schedule
                                for (var i in this.schedule)
                                {
                                    //If the added grocery matches any in the array
                                    if (this.schedule[i].description == res.data.description && this.schedule[i].day == res.data.day)
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
                                    //Update the values
                                    this.schedule[index].quantity = res.data.quantity;

                                    //Reset the form
                                    this.resetForm();
                                }
                                else
                                {
                                    //Push the added item into the schedule array
                                    this.schedule.push(res.data);

                                    //Reset the form
                                    this.resetForm();
                                }
                            });
                        }
                        catch(err) {
                            //If it can't find any groceries, return
                            return;
                        }
                    });
                }
                else
                {
                    return;
                }
            },
            getItems() {
                $('.ahGroupItem').css('border', 'none');

                //Show the list
                this.ahGroupItem = true;

                //Clear the timeout
                window.clearTimeout(this.timer);

                //Reset the arrays
                app.popularItems = [];
                app.ahItems = [];

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
                                app.popularItems.push(response[i]);
                            }

                            //Set maximum shown items
                            app.popularItems.splice(5, response.length);
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
                                        item['description'] = response[k]['_embedded']['product']['description'].replace(/[^\x00-\x7F]/g, "");
                                        item['priceNow'] = response[k]['_embedded']['product']['priceLabel']['now'];
                                        item['priceWas'] = response[k]['_embedded']['product']['priceLabel']['was'];
                                        item['image'] = response[k]['_embedded']['product']['images'][3]['link']['href'];

                                        //Push that array inside the ahItems array
                                        app.ahItems.push(item);
                                    }
                                }
                            }
                            catch(err) {
                                //If it can't find any scheduled groceries, return
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
                                app.popularItems.push(response[i]);
                            }

                            //Set maximum shown items
                            app.popularItems.splice(5, response.length);
                        });
                    }.bind(this), 500);
                }
            },
            resetForm() {
                //Reset the form
                this.description = '';
                this.image = '';
                this.quantity = 1;
                this.priceWas = 0;
                this.priceNow = 0;
                app.popularItems = [];
                app.ahItems = [];
                $('.ahGroupItem').css('border', 'none')
            },
            getValue(value, img, priceWas, priceNow) {

                //Set the description to the given value
                this.description = value;

                //Set the prices
                this.priceWas = priceWas;
                this.priceNow = priceNow;

                //Set the value of 'image' to the given value
                this.image = img;

                //Reset the array
                app.ahItems = [];

                //Hide the list
                this.ahGroupItem = false;
            }
        }
    }
</script>
<style>
.disableScroll {
    position: absolute;
    width: 100%;
    height: 100vh;
    top: calc(0px - 64px);
    left: 0;
}
.dialogContainer {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 5;
    background: #fff;
}

.slideUp-leave-active,
.slideUp-enter-active {
    transition: 0.7s;
}
.slideUp-enter-to {
    top: 0;
}
.slideUp-leave-to {
    top: 200%;
}
.slideUp-enter {
    top: 100%;
}

.dialogBody {
    height: calc(100% - 64px);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.group {
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    padding: 0px 8px;
    display: flex;
}

.groupSelect {
    flex: 1;
}

.days {
    width: 100%;
    background-color: #fff;
    border: none;
    border-bottom: 1px solid #999;
    height: 32px;
    font-size: 16px;
    color: #555;
    text-transform: capitalize;
    padding: 4px 0px 0px 5px;
}

select:focus {
    outline:none;
    border-color: #c6781d;
}

label {
    color:#555;
    font-size:18px;
    font-weight:normal;
    pointer-events:none;
    transition:0.2s ease all;
    -moz-transition:0.2s ease all;
    -webkit-transition:0.2s ease all;
    margin: 0;
    padding-top: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
}

input:focus ~ label, input:valid ~ label, select:focus ~ label, select:valid ~ label {
    top:-20px;
    font-size:14px;
    color:#d07e20;
}

.bar {
    position:relative;
    display:block;
    width:100%;
}
.bar:before, .bar:after {
    content:'';
    height:2px;
    width:0;
    bottom:1px;
    position:absolute;
    background:#d07e20;
    transition:0.2s ease all;
    -moz-transition:0.2s ease all;
    -webkit-transition:0.2s ease all;
}
.bar:before {
    left:50%;
}
.bar:after {
    right:50%;
}

input:focus ~ .bar:before, input:focus ~ .bar:after, select:focus ~ .bar:before, select:focus ~ .bar:after {
    width:50%;
}

.highlight {
    position:absolute;
    height:60%;
    width:100px;
    top:25%;
    left:0;
    pointer-events:none;
    opacity:0.5;
}

input:focus ~ .highlight, select:focus ~ .highlight {
    -webkit-animation:inputHighlighter 0.3s ease;
    -moz-animation:inputHighlighter 0.3s ease;
    animation:inputHighlighter 0.3s ease;
}

.dayFullscreen {
    padding: 14px;
}

.scheduledDay {
    padding: 0px 14px;
    overflow: auto;
    height: auto;
    max-height: calc(100vh - 285px);
}

.list-group {
    padding: 0;
}

.list-group-item {
    border-left: 0px;
    border-right: 0px;
    padding: 24.6px 24.6px;
    display: flex;
    justify-content: space-between;
    letter-spacing: normal;
    border: 1px solid #ddd;
}

.list-group-item img {
    width: 50px;
    height: 50px;
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 5%;
}

.list-group-item:first-child {
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-top: none;
}

.list-group-item:last-child {
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
}

.trashContainer {
    position: absolute;
    display: flex;
    align-items: center;
    right: 0;
}

.trash {
    display: flex;
    border-radius: 2px;
    color: #E74C3C;
    margin-left: 5px;
    cursor: pointer;
}

.addNewItem {
    position: absolute;
    display: flex;
    bottom: 0px;
    width: 100%;
    padding: 8px;
    flex-direction: column;
}

.inputItem {
    display: flex;
    width: 100%;
    border: 1px solid #ccc;
    margin-right: 10px;
    box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
}

.itemWrapper {
    display: flex;
    margin-bottom: 8px;
}

.newItem {
    border: none;
    height: 100%;
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}

.clearBox {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
}

.clear {
    border-radius: 50%;
    cursor: pointer;
}

.pulse {
    animation: pulse 2s;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
  }
  50% {
      -webkit-box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
  }
  100% {
      -webkit-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
  }
}
@keyframes pulse {
  0% {
    -moz-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
    box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
  }
  50% {
      -moz-box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
      box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
  }
  100% {
      -moz-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
      box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
  }
}

.inputQuantity {
    display: flex;
    border: 1px solid #ccc;
    box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
}

.ahGroupItem {
    position: relative;
    width: 100%;
    max-height: 370px;
    overflow-y: auto;
    margin-bottom: 8px;
}

.ahItem {
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 82px;
    text-align: center;
    cursor: pointer;
}

.ahItem img {
    width: 50px;
    height: 50px;
    margin-left: 15px;
    margin-right: auto;
}

.ahPrice {
    text-align: right;
    width: auto !important;
    position: absolute;
    right: 0;
    margin-right: 15px;
}

.priceWas {
    display: block;
}

.priceWas.bonus {
    text-decoration: line-through;
}

.priceNow {
    display: block;
}

.priceNow.bonus {
    color: #ff7900;
}

.ahItems li:first-child, .popularItems li:first-child {
    padding: 0;
    height: unset;
    cursor: default;
}

.ahItems li:first-child h4, .popularItems li:first-child h4 {
    font-size: 1.2em;
}

.quantity {
    height: 100%;
    width: 45px;
    display: block;
    font-size: 1.2em;
    padding: 10px;
    text-align: center;
    border: none;
}

.addItemButton {
    background-color: #92b558;
    border-color: #83a24f;
    display: flex;
    border: none;
    border-radius: 0px;
    outline: 0 !important;
}

.button {
    display: inline-block;
    text-align: center;
    padding: 10px;
    width: 100%;
    color: white;
    transition: 300ms ease-in-out;
    font-size: 22px;
    background-color: #d07e20;
    border: none;
    border-bottom: 3px solid #a56418;
}

.button:focus, .button:hover {
    color: #fff;
    text-decoration: none;
}

.button:hover:enabled {
    transform: translateY(-3px);
}

.disabled {
    opacity: 0.45;
    cursor: not-allowed !important;
}
</style>