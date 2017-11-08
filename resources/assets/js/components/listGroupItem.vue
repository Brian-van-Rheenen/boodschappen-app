<template>
    <div>
        <h4>Nog te halen:</h4>
        <template v-if="incompletedGroceries.length">
            <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in incompletedGroceries" :key="item.id">
                <span class="user">{{ item.user }}</span>
                <span class="hoeveelheid" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
                <span class="items" v-bind:class="{'checked': item.completed}">{{ item.description }}</span>
                <i class="fa fa-check complete" v-bind:class="{'completed': item.completed}" v-on:click="completed(item)"></i>
            </li>
        </template>
        <template v-else>
            Geen producten
        </template>

        <h4>Al gehaald:</h4>
        <template v-if="completedGroceries.length">
        <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in completedGroceries" :key="item.id">
            <span class="hoeveelheid" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
            <span class="items" v-bind:class="{'checked': item.completed}">{{ item.description }}</span>
            <i class="fa fa-check complete" v-bind:class="{'completed': item.completed}" v-on:click="completed(item)"></i>
        </li>
        </template>
        <template v-else>
            Geen producten
        </template>
    </div>
</template>
<script>
    export default {
        name: 'listGroupItem',
        props: ['groceries'],
        data() {
            return {
                completedGroceries: this.groceries.filter(item => item.completed),
                incompletedGroceries: this.groceries.filter(item => !item.completed)
            }
        },
        watch: {
            groceries() {
                this.completedGroceries  = this.groceries.filter(item => item.completed);
                this.incompletedGroceries = this.groceries.filter(item => !item.completed);
                this.sortGroceries();
            }
        },
        methods: {
            completed(item) {
                item.completed = !item.completed;

                if (item.completed)
                {
                    var index = this.incompletedGroceries.findIndex(x => x.id==item.id);
                    this.completedGroceries.push(item);
                    this.incompletedGroceries.splice(index, 1);
                }
                else
                {
                    var index = this.completedGroceries.findIndex(x => x.id==item.id);
                    this.incompletedGroceries.push(item);
                    this.completedGroceries.splice(index, 1);
                }

                this.sortGroceries();

                axios.post(`/boodschappen/${item.id}/update`, {
                    completed: item.completed
                });
            },
            sortGroceries() {
                this.incompletedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });

                this.completedGroceries.sort((a, b) => {
                    return new Date(b.created_at).getTime() - new Date(a.created_at).getTime();
                });
            }
        }
    }
</script>