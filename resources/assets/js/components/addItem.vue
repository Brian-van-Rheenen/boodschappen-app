<template>
    <form method="POST" action="/boodschappen" class="addNewItem" v-ajax>

        <input type="text" class="newItem" name="description" placeholder="Voeg toe" required></input>
        <input type="number" class="quantity" name="quantity" placeholder="1" required></input>
        <button type="submit" class="btn btn-success addItemButton"><i class="fa fa-plus addItemIcon"></i></button>
    </form>
</template>
<script>
    export default {
        name: 'additem',
        data() {
            return {

            }
        }
    }
</script>