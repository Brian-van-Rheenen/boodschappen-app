<section class="footer">
    <form class="addNewItem">
        <ul class="list-group ahGroupItem" v-if="popularItems.length || ahItems.length">
            <div class="popularItems" v-if="popularItems.length">
                <li class="list-group-item ahItem"><h4>Top 5 populairste items:</h4></li>
                <li class="list-group-item ahItem" v-for="item in popularItems" @click="getValue(item.productID,item.description,item.image,item.priceWas,item.priceNow,item.discount)"><div class="ribbon" v-if="item.priceWas || item.discount"><span>@{{ item.discount }}</span></div><img :src="item.image" v-if="item.image"><span class="ahDescription" v-bind:class="{'centered': !item.image}">@{{ item.description }}</span><span class="ahPrice" v-if="item.image"><span class="priceWas" v-bind:class="{'bonus': item.priceNow}">@{{ item.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': item.priceWas}">@{{ item.priceNow }}</span></span></li>
            </div>
            <div class="ahItems" v-if="ahItems.length">
                <li class="list-group-item ahItem"><h4>Suggesties:</h4></li>
                <li class="list-group-item ahItem" v-for="ahItem in ahItems" @click="getValue(ahItem.productID,ahItem.description,ahItem.image,ahItem.priceWas,ahItem.priceNow,ahItem.discount)"><div class="ribbon" v-if="ahItem.priceWas || ahItem.discount"><span>@{{ ahItem.discount }}</span></div><img :src="ahItem.image" v-if="ahItem.image"><span class="ahDescription">@{{ ahItem.description }}</span><span class="ahPrice"><span class="priceWas" v-bind:class="{'bonus': ahItem.priceNow}">@{{ ahItem.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': ahItem.priceWas}">@{{ ahItem.priceNow }}</span></span></li>
            </div>
        </ul>

        <input type="hidden" class="hiddenImg" name="image" v-model="image">
        <input type="text" class="newItem" name="description" autocomplete="off" v-model="description" v-on:keyup="getItems('this')" placeholder="Voeg toe" @click="getItems('this')" required></input>
        <i class="material-icons clear">clear</i>
        <input type="number" class="quantity" name="quantity" autocomplete="off" v-model="quantity" required></input>
        <button type="button" class="btn btn-success addItemButton" @click="quantity += 1"><i class="material-icons">add</i></button>
    </form>

    <button type="button" class="btn-circle btn-xl reset"><i class="material-icons footer-buttons">clear</i></button>
    <button type="button" class="btn-circle btn-xl delete"><i class="material-icons footer-buttons">remove</i></button>
    <button type="button" class="btn-circle btn-xl add"><i class="material-icons footer-buttons">add</i></button>
</section>