<template>
    <div>
        <template v-if="historyLog.length">
            <li class="list-group-item history" v-for="item in historyLog">
                <span class="historyDate">{{ item.created_at }}:</span>
                <span class="historyDescription"><span class="historyUser">{{ item.user }}</span> {{ item.textBefore }} {{ item.quantity }} <strong>{{ item.description }}</strong> {{ item.textAfter }}</span>
            </li>
        </template>
        <template v-else>
            <span class="empty">Geen geschiedenis gevonden.</span>
        </template>
    </div>
</template>
<script>
    export default {
        name: 'history',
        props: ['history'],
        data() {
            return {
                historyLog: this.history
            }
        }
    }
</script>