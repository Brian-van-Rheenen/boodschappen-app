<template>
    <div>
        <li class="list-group-item" v-bind:class="{'done': item.completed}" v-for="item in sortedGroceries">
            <span class="hoeveelheid" v-bind:class="{'checked': item.completed}">{{ item.quantity }}x</span>
            <span class="items" v-bind:class="{'checked': item.completed}">{{ item.description }}</span>
            <i class="fa fa-check complete" v-bind:class="{'completed': item.completed}" v-on:click="completed(item.id)"></i>
        </li>
    </div>
</template>
<script>
    export default {
        name: 'listGroupItem',
        props: ['groceries'],
        computed: {
            sortedGroceries() {
                return this.groceries.sort((a, b) => a.completed - a.created_at || b.completed - b.created_at);
            }
        },
        methods: {
            completed(id) {
                var groceries = this.groceries;
                var index = groceries.findIndex(x => x.id==id);

                if (groceries[index].completed == 0)
                {
                    var completed = 1;
                }
                else
                {
                    var completed = 0;
                }

                axios.post('/boodschappen/' + id + '/update', {

                    completed: completed
                }).then(function(res){

                    groceries[index].completed = completed;
                });
            }
        }
    }
</script>