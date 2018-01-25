<template>
    <div v-bind:class="{'changeHeight': !groceries.length}">
        <template v-if="groceries.length">
            <h4>Nog te halen:</h4>
            <template v-if="incompletedGroceries.length">
                <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in incompletedGroceries" :key="item.id">
                    <div class="ribbon" v-if="item.priceWas || item.discount"><span>{{ item.discount }}</span></div>
                    <span class="user">{{ item.user }}</span>
                    <span class="hoeveelheid" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
                        <img :src="item.image" v-if="item.image">
                    <div class="items">
                        <span v-bind:class="{'checked': item.completed, 'centered': !item.image}">{{ item.description }}</span>
                        <div class="price" v-if="item.image">
                            <span class="priceWas" style="display: unset;" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span>
                            <span class="priceNow" style="display: unset;" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span>
                        </div>
                    </div>
                    <i class="material-icons complete" v-bind:class="{'completed': item.completed}" v-on:click="completed(item)">check</i>
                </li>
            </template>
            <template v-else>
                <span class="empty">Geen producten</span>
            </template>

            <h4>Al gehaald:</h4>
            <template v-if="completedGroceries.length">
            <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in completedGroceries" :key="item.id">
                <div class="ribbon" v-if="item.priceWas || item.discount"><span>{{ item.discount }}</span></div>
                <span class="hoeveelheid" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
                <img :src="item.image" v-if="item.image">
                <div class="items" v-bind:class="{'checked': item.completed}">
                    <span v-bind:class="{'checked': item.completed, 'centered': !item.image}">{{ item.description }}</span>
                    <div class="price" v-if="item.image">
                        <span class="priceWas" style="display: unset;" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span>
                        <span class="priceNow" style="display: unset;" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span>
                    </div>
                </div>
                <i class="material-icons complete"  v-bind:class="{'completed': item.completed}" v-on:click="completed(item)">check</i>
            </li>
            </template>
            <template v-else>
                <span class="empty">Geen producten</span>
            </template>
        </template>
        <template v-else>
            <div class="emptyTrash">
                <span>Geen producten gevonden</span>
                <i class="fa fa-trash-o"></i>
            </div>
        </template>
    </div>
</template>
<script>
    export default {
        name: 'listGroupItemGroceries',
        props: ['groceries'],
        data() {
            return {
                completedGroceries: this.groceries.filter(item => item.completed),
                incompletedGroceries: this.groceries.filter(item => !item.completed)
            }
        },
        mounted() {

            //Create an interval every 15 seconds
            window.setInterval(() => {
              this.loadData();
            }, 5000);
        },
        watch: {
            groceries() {
                //Filter both groceries arrays
                this.completedGroceries  = this.groceries.filter(item => item.completed);
                this.incompletedGroceries = this.groceries.filter(item => !item.completed);

                //Sort the arrays
                this.sortGroceries();
            }
        },
        methods: {
            loadData() {

                //Fetch all the groceries
                $.get('/boodschappen/alles', function (response) {

                    //Filter both groceries arrays
                    app.groceries = response;
                    this.completedGroceries  = response.filter(item => item.completed);
                    this.incompletedGroceries = response.filter(item => !item.completed);
                }.bind(this));
            },
            completed(item) {
                //Toggle the completed state of the grocery
                item.completed = !item.completed;

                //If it's completed
                if (item.completed)
                {
                    //Find the index of this grocery item
                    var index = this.incompletedGroceries.findIndex(x => x.id==item.id);

                    //Push the item into the completed array
                    this.completedGroceries.push(item);

                    //Remove the item from the incomplete array
                    this.incompletedGroceries.splice(index, 1);
                }
                else
                {
                    //Find the index of this grocery item
                    var index = this.completedGroceries.findIndex(x => x.id==item.id);

                    //Push the item into the incompleted array
                    this.incompletedGroceries.push(item);

                    //Remove the item from the complete array
                    this.completedGroceries.splice(index, 1);
                }

                //Sort the groceries
                this.sortGroceries();

                //Update the database value
                axios.post(`/boodschappen/${item.id}/update`, {
                    completed: item.completed
                });
            },
            sortGroceries() {

                //Sort the incompleted groceries by the created_at time
                this.incompletedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });

                //Sort the completed groceries by the created_at time
                this.completedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });
            }
        }
    }
</script>