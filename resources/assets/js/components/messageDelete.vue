<template>
    <div>
        <div class="shadow"></div>
        <div class="messageContainer">
            <div class="message resetItems">
                <div class="messageHeader red">
                    <i class="fa fa-times circle"></i>
                </div>
                <div class="messageDescription">
                    <span class="title">Verwijder?</span>
                    <span class="description">Weet je zeker dat je  wilt resetten? Dit <strong>verwijdert</strong> het permanent</span>
                </div>
                <div class="buttonContainer">
                    <button type="button" class="btn btn-danger confirmationButton">Nee!</button>
                    <button type="button" class="btn btn-success confirmationButton" v-on:click="trash()">Ja!</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'messageDelete',
        props: ['users', 'user'],
        methods: {
            trash() {
                //Find the index of this user
                var index = this.users.findIndex(x => x.id==this.user.id);

                //Remove the user from the array
                this.users.splice(index, 1);

                //Remove the user from the database
                axios.post(`/users/${this.user.id}/delete`, {
                    id: this.user.id
                }).then((res) => {
                    this.$root.resetFlashMessages();
                    this.$root.flashMessages.push(res.data);
                    $('.user-form-add').show();
                    $('.user-form-edit').hide();

                    app.$root.resetInput();
                });
            }
        }
    }
</script>