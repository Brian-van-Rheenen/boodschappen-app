<template>
    <div style="width: 70%" v-if="success.length || errors.length">
        <div id="flash-message" class="alert alert-success" role="alert" v-if="success.length">
            <p v-for="item in success">
                {{ item.description }}
            </p>
        </div>
        <div id="flash-message" class="alert alert-danger" role="alert" v-if="errors.length">
            <p v-for="item in errors">
                {{ item.description }}
            </p>
        </div>
    </div>

</template>
<script>
    export default {
        name: 'errors',
        computed: {
            success() {
                return this.$root.flashMessages.filter(msg => msg.type == 'success');
            },
            errors() {
                return this.$root.flashMessages.filter(msg => msg.type == 'error');
            }
        }
    }
</script>