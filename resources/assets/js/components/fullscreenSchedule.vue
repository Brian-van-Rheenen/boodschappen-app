<template>
    <div class="disableScroll">
        <transition name="slideUp">
            <div class="dialogContainer" v-if="showDialog">
                <header class="layout-header">
                    <button class="header-drawer-toggle">
                        <i class="material-icons" v-on:click="dialog(false)">clear</i>
                    </button>
                    <span class="header-title">Boodschappen Toevoegen</span>
                </header>

                <section class="dialogBody">
                    <div class="group">
                        <label class="label-role">Kies een dag:</label>
                        <div class="groupSelect">
                            <select class="days" name="days" v-model="selectedDate" required>
                                <option v-for="day in days" v-bind:value="day.name" v-text="day.name"></option>
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div>
                    </div>

                    <div class="schedule">
                        <div class="day" v-bind:class="{ scheduledDay: selectedDate }">
                            <ul class="schedule-group">
                                <template v-if="selectedDate">
                                    <template v-for="day in days" v-if="day.name == selectedDate">
                                        <template v-if="day.data.length">
                                            <template v-for="data in day.data">
                                                <li class="schedule-group-item">
                                                    <div class="container">
                                                        <span class="hoeveelheid">{{data.quantity }}x</span>
                                                        <img :src="data.image" v-if="data.image">
                                                    </div>
                                                    <div class="items">{{ data.description }}</div>
                                                    <div class="trashContainer">
                                                        <i class="material-icons trash" v-on:click="trash(data)">delete</i>
                                                    </div>
                                                </li>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <div class="items" style="padding: 14px 0px 14px 0px;">Geen producten gevonden</div>
                                        </template>
                                    </template>
                                </template>
                                <template v-else>
                                    <div class="items" style="padding-top: 14px;">Geen dag gekozen</div>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <form class="addNewItem">
                        <ul class="list-group ahGroupItem" v-if="this.$root.popularItems.length || this.$root.ahItems.length">
                            <div class="popularItems" v-if="this.$root.popularItems.length">
                                <li class="list-group-item ahItem"><h4>Top 5 populairste items:</h4></li>
                                <li class="list-group-item ahItem" v-for="item in this.$root.popularItems" @click="getValue(item.productID,item.description,item.image,item.priceWas,item.priceNow,item.discount)">
                                    <div class="ribbon" v-if="item.priceWas || item.discount"><span>{{ item.discount }}</span></div>
                                    <div class="container">
                                        <img :src="item.image" v-if="item.image">
                                    </div>
                                    <div class="items">{{ item.description }}</div>
                                    <span class="ahPrice" v-if="item.image"><span class="priceWas" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span></span>
                                </li>
                            </div>
                            <div class="ahItems" v-if="this.$root.ahItems.length">
                                <li class="list-group-item ahItem"><h4>Suggesties:</h4></li>
                                <li class="list-group-item ahItem" v-for="item in this.$root.ahItems" @click="getValue(item.productID,item.description,item.image,item.priceWas,item.priceNow,item.discount)">
                                    <div class="ribbon" v-if="item.priceWas || item.discount"><span>{{ item.discount }}</span></div>
                                    <div class="container">
                                        <img :src="item.image" v-if="item.image">
                                    </div>
                                    <div class="items">{{ item.description }}</div>
                                    <span class="ahPrice" v-if="item.image"><span class="priceWas" v-bind:class="{'bonus': item.priceNow}">{{ item.priceWas }}</span><span class="priceNow" v-bind:class="{'bonus': item.priceWas}">{{ item.priceNow }}</span></span>
                                </li>
                            </div>
                        </ul>

                        <div class="itemWrapper">
                            <div class="inputItem">
                                <input type="hidden" class="hiddenImg" name="image" v-model="image">
                                <input type="text" class="newItem" name="description" autocomplete="off" v-model="description" v-on:keyup="getItems('app')" placeholder="Voeg toe" @click="getItems('app')" required></input>
                                <div class="clearBox"><i class="material-icons clear" v-on:click="clear">clear</i></div>
                            </div>

                            <div class="inputQuantity">
                                <input type="number" class="quantity" name="quantity" autocomplete="off" v-model="quantity" required></input>
                                <button type="button" class="btn btn-success addItemButton" @click="quantity += 1"><i class="material-icons">add</i></button>
                            </div>
                        </div>
                        <input type="button" class="button" value="Boodschap toevoegen" v-bind:class="{ disabled: disabled }" v-on:click="addItem('/planning', this.schedule)" :disabled="disabled">
                    </form>
                </section>
            </div>
        </transition>
    </div>
</template>
<script>
    import groceriesDatabase from '../mixin/groceriesDatabase';

    export default {
        name: 'fullscreenSchedule',
        props: ['schedule', 'show'],
        data() {
            return {
                id: '',
                description: '',
                quantity: 1,
                priceWas: 0,
                priceNow: 0,
                discount: '',
                image: '',
                timer: '',
                showDialog: false,
                selectedDate: '',
                disabled: true
            }
        },
        mixins: [groceriesDatabase],
        watch: {
            show() {
                this.showDialog = this.show;
            },
            selectedDate() {
                if (this.selectedDate != '')
                {
                    this.disabled = false;
                }
                else
                {
                    this.disabled = true;
                }
            }
        },
        computed: {
            fullscreen: {
                get: function() {
                    return this.show;
                },

                set: function(bool) {
                    this.showDialog = bool;
                    app.$children[0].fullscreen = bool;

                    if (bool == false)
                    {
                        this.description = '';
                        this.quantity = 1;
                        this.priceWas = 0,
                        this.priceNow = 0,
                        this.image = '';
                        this.selectedDate = '';
                        this.disabled = true;
                    }
                }
            },
            days() {
                return [
                    { name: 'maandag', data: this.schedule.filter(name => name.day == 'maandag') },
                    { name: 'dinsdag', data: this.schedule.filter(name => name.day == 'dinsdag') },
                    { name: 'woensdag', data: this.schedule.filter(name => name.day == 'woensdag') },
                    { name: 'donderdag', data: this.schedule.filter(name => name.day == 'donderdag') },
                    { name: 'vrijdag', data: this.schedule.filter(name => name.day == 'vrijdag') }
                ];
            }
        },
        methods: {
            dialog(bool) {
                this.fullscreen = false;

                $("body").css("overflow", "auto");
                $(".disableScroll").css('top', '');
            },
            trash(item) {
                //Find the index of this scheduled grocery item
                var index = this.schedule.findIndex(x => x.id==item.id);

                //Remove the item from the array
                this.schedule.splice(index, 1);

                //Remove the scheduled grocery from the database
                axios.post(`/planning/${item.id}/delete`, {
                    id: item.id
                });
            },
            clear() {
                $('.clear').addClass('pulse');
                this.resetForm();

                $('.clear').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e)
                {
                    $('.clear').removeClass('pulse');
                });
            },
            resetForm() {
                //Reset the form
                this.id = '';
                this.description = '';
                this.image = '';
                this.quantity = 1;
                this.priceWas = 0;
                this.priceNow = 0;
                this.discount = '';
                app.popularItems = [];
                app.ahItems = [];
            },
            getValue(id, value, img, priceWas, priceNow, discount) {

                //Set id
                this.id = id;

                //Set the description to the given value
                this.description = value;

                //Set the prices
                this.priceWas = priceWas;
                this.priceNow = priceNow;

                //Set the discount label
                this.discount = discount;

                //Set the value of 'image' to the given value
                this.image = img;

                //Reset the array
                app.popularItems = [];
                app.ahItems = [];
            }
        }
    }
</script>
<style lang="scss">
.disableScroll {
    position: absolute;
    width: 100%;
    height: 100vh;
    top: calc(0px - 64px);
    left: 0;
}
.dialogContainer {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 5;
    background: #fff;
}

.slideUp-leave-active,
.slideUp-enter-active {
    transition: 0.7s;
}
.slideUp-enter-to {
    top: 0;
}
.slideUp-leave-to {
    top: 200%;
}
.slideUp-enter {
    top: 100%;
}

.dialogBody {
    height: calc(100% - 64px);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.group {
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    padding: 0px 8px;
    display: flex;
}

.groupSelect {
    flex: 1;
}

.days {
    width: 100%;
    background-color: #fff;
    border: none;
    border-bottom: 1px solid #999;
    height: 32px;
    font-size: 16px;
    color: #555;
    text-transform: capitalize;
    padding: 4px 0px 0px 5px;
}

input {
    &:-webkit-autofill,
    &:-webkit-autofill:hover,
    &:-webkit-autofill:focus,
    &:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset;
        -webkit-text-fill-color: #555 !important;
        transition: background-color 5000s ease-in-out 0s;
    }

    &:focus ~ .bar:before,
    &:focus ~ .bar:after {
        width:50%;
    }

    &:focus ~ .highlight {
        -webkit-animation:inputHighlighter 0.3s ease;
        -moz-animation:inputHighlighter 0.3s ease;
        animation:inputHighlighter 0.3s ease;
    }
}

select {
    &:focus {
        outline:none;
        border-color: #c6781d;
    }

    &:focus ~ .bar:before,
    &:focus ~ .bar:after {
        width:50%;
    }

    &:focus ~ .highlight {
        -webkit-animation:inputHighlighter 0.3s ease;
        -moz-animation:inputHighlighter 0.3s ease;
        animation:inputHighlighter 0.3s ease;
    }
}

label {
    color:#555;
    font-size:18px;
    font-weight:normal;
    pointer-events:none;
    transition:0.2s ease all;
    -moz-transition:0.2s ease all;
    -webkit-transition:0.2s ease all;
    margin: 0;
    padding-top: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.bar {
    position:relative;
    display:block;
    width:100%;

    &:before,
    &:after {
        content:'';
        height:2px;
        width:0;
        bottom:1px;
        position:absolute;
        background:#d07e20;
        transition:0.2s ease all;
        -moz-transition:0.2s ease all;
        -webkit-transition:0.2s ease all;
    }

    &:before {
        left: 50%;
    }

    &:after {
        right: 50%;
    }
}

.highlight {
    position:absolute;
    height:60%;
    width:100px;
    top:25%;
    left:0;
    pointer-events:none;
    opacity:0.5;
}

.dayFullscreen {
    padding: 14px;
}

.scheduledDay {
    padding: 0px 14px;
    overflow: auto;
    height: auto;
    max-height: calc(100vh - 285px);
}

.list-group {
    padding: 0;

    &.ahGroupItem {
        position: relative;
        width: 100%;
        max-height: 370px;
        overflow-y: auto;
        margin-bottom: 8px;
        border: 1px solid #ccc;
    }
}

.list-group-item {
    border-left: 0px;
    border-right: 0px;
    padding: 24.6px 24.6px;
    display: flex;
    justify-content: space-between;
    letter-spacing: normal;
    border: 1px solid #ddd;

    &:first-child {
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-top: none;
    }

    &:last-child {
        border-bottom-right-radius: 0px;
        border-bottom-left-radius: 0px;
    }
}

.ahItem {
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 82px;
    text-align: center;
    cursor: pointer;

    img {
        width: 50px;
        height: 50px;
        margin-left: 15px;
        margin-right: auto;
    }
}

.trashContainer {
    position: absolute;
    display: flex;
    align-items: center;
    right: 0;
}

.trash {
    display: flex;
    border-radius: 2px;
    color: #E74C3C;
    margin-left: 5px;
    cursor: pointer;
}

.addNewItem {
    position: absolute;
    display: flex;
    bottom: 0px;
    width: 100%;
    padding: 8px;
    flex-direction: column;
}

.inputItem {
    display: flex;
    width: 100%;
    border: 1px solid #ccc;
    margin-right: 10px;
    box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
}

.itemWrapper {
    display: flex;
    margin-bottom: 8px;
}

.newItem {
    border: none;
    height: 100%;
    width: 100%;
    padding: 10px;
    font-size: 1.2em;
}

.clearBox {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
}

.clear {
    border-radius: 50%;
    cursor: pointer;
}

.pulse {
    animation: pulse 2s;
}

@-webkit-keyframes pulse {
  0% {
    -webkit-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
  }
  50% {
      -webkit-box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
  }
  100% {
      -webkit-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
  }
}
@keyframes pulse {
  0% {
    -moz-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
    box-shadow: 0 0 0 0 rgba(183, 185, 188, 0.4);
  }
  50% {
      -moz-box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
      box-shadow: 0 0 0 10px rgba(183, 185, 188, 0);
  }
  100% {
      -moz-box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
      box-shadow: 0 0 0 0 rgba(183, 185, 188, 0);
  }
}

.inputQuantity {
    display: flex;
    border: 1px solid #ccc;
    box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
}

.ahPrice {
    text-align: right;
    width: auto !important;
    position: absolute;
    right: 0;
    margin-right: 15px;
}

.priceWas {
    display: block;

    &.bonus {
        text-decoration: line-through;
    }
}

.priceNow {
    display: block;

    &.bonus {
        color: #ff7900;
    }
}

.ahItems li:first-child, .popularItems li:first-child {
    padding: 0;
    height: unset;
    cursor: default;
}

.ahItems li:first-child h4, .popularItems li:first-child h4 {
    font-size: 1.2em;
}

.quantity {
    height: 100%;
    width: 45px;
    display: block;
    font-size: 1.2em;
    padding: 10px;
    text-align: center;
    border: none;
}

.addItemButton {
    background-color: #92b558;
    border-color: #83a24f;
    display: flex;
    border: none;
    border-radius: 0px;
    outline: 0 !important;
}

.button {
    display: inline-block;
    text-align: center;
    padding: 10px;
    width: 100%;
    color: white;
    transition: 300ms ease-in-out;
    font-size: 22px;
    background-color: #d07e20;
    border: none;
    border-bottom: 3px solid #a56418;

    &:focus,
    &:hover {
        color: #fff;
        text-decoration: none;
    }

    &:hover:enabled {
        transform: translateY(-3px);
    }

    &.disabled {
        opacity: 0.45;
        cursor: not-allowed !important;
    }
}
</style>