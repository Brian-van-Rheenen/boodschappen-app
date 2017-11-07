<section class="footer">
    <form method="POST" action="/boodschappen" class="addNewItem" @submit.prevent="addItem">
        {{ csrf_field() }}
        <input type="text" class="newItem" name="description" v-model="description" placeholder="Voeg toe" required></input>
        <input type="number" class="quantity" name="quantity" v-model="quantity" placeholder="1" required></input>
        <input type="hidden" name="completed">
        <button type="submit" class="btn btn-success addItemButton"><i class="fa fa-plus addItemIcon"></i></button>
    </form>

    <button type="button" class="btn btn-danger btn-circle btn-xl reset"><i class="fa fa-times"></i></button>
    <button type="button" class="btn btn-success btn-circle btn-xl save"><i class="fa fa-check"></i></button>
    <button type="button" class="btn btn-primary btn-circle btn-xl add"><i class="fa fa-plus"></i></button>
    <!--
    <button type="button" class="btn btn-danger reset">Reset</button>
    <button type="button" class="btn btn-success save">✓</button>
    -->
</section>