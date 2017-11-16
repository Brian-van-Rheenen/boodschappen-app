<template>
    <div class="trashInnerContainer">
        <template v-if="completedGroceries.length || incompletedGroceries.length">
            <template v-if="incompletedGroceries.length">
            <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in incompletedGroceries" :key="item.id">
                <span class="hoeveelheid trash-left" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
                <img :src="item.image" v-if="item.image">
                <span class="items" v-bind:class="{'checked': item.completed, 'centered': !item.image}">{{ item.description }}</span>
                <i class="material-icons trash-right"  v-on:click="trash(item)">delete</i>
            </li>
            </template>
            <template v-if="completedGroceries.length">
            <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in completedGroceries" :key="item.id">
                <span class="hoeveelheid trash-left" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
                <img :src="item.image" v-if="item.image">
                <span class="items" v-bind:class="{'checked': item.completed, 'centered': !item.image}">{{ item.description }}</span>
                <i class="material-icons trash-right"  v-on:click="trash(item)">delete</i>
            </li>
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
        name: 'listGroupItemTrash',
        props: ['groceries'],
        data() {
            return {
                completedGroceries: this.groceries.filter(item => item.completed),
                incompletedGroceries: this.groceries.filter(item => !item.completed)
            }
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
            sortGroceries() {

                //Sort the incompleted groceries by the created_at time
                this.incompletedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });

                //Sort the completed groceries by the created_at time
                this.completedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });
            },
            trash(item) {
                //Find the index of this grocery item
                var index = this.groceries.findIndex(x => x.id==item.id);

                //Remove the item from the incomplete array
                this.groceries.splice(index, 1);

                //Remove the grocery from the database
                axios.post(`/boodschappen/${item.id}/delete`, {
                    id: item.id
                });
            }
        }
    }
</script>