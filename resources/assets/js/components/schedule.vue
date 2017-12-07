<template>
    <div class="schedule">
        <fullscreenSchedule :schedule="schedule" :show="fullscreen"></fullscreenSchedule>
        <div class="day" v-for="day in days">
            <div class="dayTitle">{{ day.name }}</div>
            <ul class="schedule-group">
                <template v-if="day.data.length">
                    <template v-for="data in day.data">
                        <li class="schedule-group-item">
                            <div class="container">
                                <span class="hoeveelheid">{{ data.quantity }}x</span>
                                <img :src="data.image" v-if="data.image">
                            </div>
                            <div class="items">{{ data.description }}</div>
                        </li>
                    </template>
                </template>
                <template v-else>
                    <div class="items">Geen producten gevonden</div>
                </template>
            </ul>
        </div>
        <button type="button" class="btn-circle btn-xl add" v-on:click="dialog(true)"><i class="material-icons footer-buttons">add</i></button>
    </div>
</template>
<script>
    import Fullscreenschedule from './fullscreenSchedule';
    export default {
        components: {
            'fullscreenSchedule': Fullscreenschedule
        },
        name: 'schedule',
        props: ['schedule'],
        data() {
            return {
                fullscreen: false
            }
        },
        computed: {
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
                this.fullscreen = true;

                $("body").css("overflow", "hidden");
                $(".disableScroll").css('top', $(window)[0].scrollY - 64);
            }
        }
    }
</script>
<style lang="scss">
.schedule {
    position: relative;
    height: 100%;
    width: 100%;
    padding: 8px;
    display: block;
}

.day {
    height: auto;
    width: 100%;
    padding: 0px 14px 14px 14px;
    margin-bottom: 8px;
    border-radius: 2px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);

    &:last-of-type {
        margin: 0;
    }
}

.dayTitle {
    display: flex;
    justify-content: center;
    padding-top: 24px;
    padding-bottom: 16px;
    font-size: 24px;
    text-transform: capitalize;
}

.schedule-group {
    margin: 0;
    padding: 0px;
}

.schedule-group-item {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50px;
    letter-spacing: normal;
    border: none;
    padding: 11px 0px;

    img {
        width: 50px;
        height: 50px;
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 5%;
    }

    &:last-child:not(:first-child) {
        padding: 11px 0px 11px 0px;
    }
}

.container {
    position: absolute;
    display: flex;
    align-items: center;
    left: 0;
    padding: 0px;
    margin: 0px;
}

.hoeveelheid {
    width: 20px;
}

.hoeveelheid, .items {
    display: flex;
    align-items: center;
}

.items {
    position: relative;
    max-width: 135px;
    min-height: 50px;
    margin: 0;
    word-break: break-word;
    margin-right: auto;
    margin-left: auto;
    text-align: center;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
    outline: none;
    z-index: 4;

    &.btn-circle.btn-xl {
        width: 56px;
        height: 56px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: auto;
        margin-bottom: auto;
        box-shadow: 0 4px 8px rgba(0,0,0,.25);
        border: 1px solid transparent;
        color: #fff;

        &.add {
            background-color: #92b558;
            border-color: #83a24f;
            margin-left: auto;
            cursor: pointer;
            outline: none !important;
            transition:all 0.3s;
            position: fixed;
            bottom: 8px;
            right: 8px;

            &:active,
            &:hover,
            &:focus {
                background-color: #749046;
                border-color: #667e3d;
            }
        }
    }
}

.footer-buttons {
    font-size: 28px;
}
</style>