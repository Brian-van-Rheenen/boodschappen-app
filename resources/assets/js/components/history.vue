<template>
    <div class="changeHeight">
        <template v-if="historyLog.length">
            <li class="list-group-item history" v-for="item in historyLog">
                <span class="historyDate">{{ item.created_at }}:</span>
                <span class="historyDescription"><span class="historyUser">{{ item.user }}</span> {{ item.textBefore }} {{ item.quantity }} <strong>{{ item.description }}</strong> {{ item.textAfter }}</span>
            </li>
        </template>
        <template v-else>
            <div class="emptyHistory">
                <span>Geen geschiedenis gevonden.</span>
                <i class="fa fa-history"></i>
            </div>
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
        },
        mounted() {

            //Create an interval every 15 seconds
            window.setInterval(() => {
              this.loadData();
            }, 15000);
        },
        methods: {
            loadData() {

                //Fetch the history
                $.get('/history/alles', function (response) {

                    //Update the history log
                    this.historyLog = response;
                }.bind(this));
            }
        }
    }
</script>