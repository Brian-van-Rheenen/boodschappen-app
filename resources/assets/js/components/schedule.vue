<template>
    <div class="schedule">
        <div class="day">

        </div>
    </div>
</template>
<script>
    export default {
        name: 'schedule',
        props: ['schedule']
    }
</script>
<style>
.schedule {
    height: 100%;
    width: 100%;
    padding: 8px;
    display: flex;
    justify-content: center;
}

.day {
    height: 200px;
    width: 100%;
    border-radius: 2px;
    box-shadow: 0 2px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}
</style>