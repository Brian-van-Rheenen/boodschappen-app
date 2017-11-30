<section class="footer">
    <form class="addNewItem">
        <ul class="list-group ahGroupItem" v-if="ahGroupItem">
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
        <input type="text" class="newItem" name="description" autocomplete="off" v-model="description" v-on:keyup="getItems" placeholder="Voeg toe" @click="getItems()" required></input>
        <i class="material-icons clear">clear</i>
        <input type="number" class="quantity" name="quantity" autocomplete="off" v-model="quantity" required></input>
        <button type="button" class="btn btn-success addItemButton" @click="quantity += 1"><i class="material-icons">add</i></button>
    </form>

    <button type="button" class="btn-circle btn-xl reset"><i class="material-icons footer-buttons">clear</i></button>
    <button type="button" class="btn-circle btn-xl delete"><i class="material-icons footer-buttons">remove</i></button>
    <button type="button" class="btn-circle btn-xl add"><i class="material-icons footer-buttons">add</i></button>
</section>