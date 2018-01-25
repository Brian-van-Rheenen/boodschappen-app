<section class="body">
    <ul class="list-group" v-bind:class="{'changeHeight': !groceries.length}">
        <listGroupItemGroceries :groceries="groceries"></listGroupItemGroceries>
    </ul>
</section>