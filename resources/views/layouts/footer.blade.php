<section class="footer">
    <form method="POST" action="/boodschappen" class="addNewItem" @submit.prevent="addItem">
        {{ csrf_field() }}

        <ul class="list-group ahGroupItem">
            <div class="popularItems" v-if="popularItems.length">
                <li class="list-group-item ahItem"><h4>Top 5 populairste items:</h4></li>
                <li class="list-group-item ahItem" v-for="item in popularItems" @click="getValue(item.description,item.image)"><img :src="item.image" v-if="item.image"><span v-bind:class="{'centered': !item.image}">@{{ item.description }}</span></li>
            </div>
            <div class="ahItems" v-if="ahItems.length">
                <li class="list-group-item ahItem"><h4>Suggesties:</h4></li>
                <li class="list-group-item ahItem" v-for="ahItem in ahItems" @click="getValue(ahItem.description,ahItem.image)"><img :src="ahItem.image" v-if="ahItem.image"><span>@{{ ahItem.description }}</span></li>
            </div>
        </ul>

        <input type="hidden" class="hiddenImg" name="image" v-model="image">
        <input type="text" class="newItem" name="description" v-model="description" v-on:keyup="getItems" placeholder="Voeg toe" @click="getItems()" required></input>
        <input type="number" class="quantity" name="quantity" v-model="quantity" required></input>
        <button type="submit" class="btn btn-success addItemButton"><i class="fa fa-plus addItemIcon"></i></button>
    </form>

    <button type="button" class="btn btn-danger btn-circle btn-xl reset"><i class="fa fa-times"></i></button>
    <button type="button" class="btn btn-warning btn-circle btn-xl delete"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-primary btn-circle btn-xl add"><i class="fa fa-plus"></i></button>
</section>