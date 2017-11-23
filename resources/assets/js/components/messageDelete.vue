<template>
    <div v-if="confirmationMessage">
        <div class="shadow"></div>
        <div class="messageContainer">
            <div class="message">
                <div class="messageHeader">
                    <i class="fa fa-times circle"></i>
                </div>
                <div class="messageDescription">
                    <span class="title">{{ title }}</span>
                    <span class="description">{{ message }} <strong>{{ email }}</strong> <br><br> Dit <strong>{{ action }}</strong> {{ remaining }}</span>
                </div>
                <div class="buttonContainer">
                    <button type="button" class="confirmationButton" v-on:click="confirmationMessage = false"><span>Annuleren</span></button>
                    <button type="button" class="confirmationButton" v-on:click="confirm(); confirmationMessage = false"><span>{{ buttonSpan }}</span></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'messageDelete',
        props: ['title', 'message', 'action', 'remaining', 'onClick', 'buttonSpan', 'users', 'user'],
        computed: {
            confirmationMessage: {
                get: function() {
                    if (this.$root.confirmationMessage)
                    {
                        $('body').css('overflow', 'hidden');
                    }
                    return this.$root.confirmationMessage;
                },

                set: function(bool) {
                    app.$root.confirmationMessage = bool;
                    $('body').css('overflow', 'auto');
                }
            },
            email() {
                if (this.user)
                {
                    return this.user.email;
                }
                else
                {
                    return '';
                }
            }
        },
        methods: {
            confirm() {
                //Check which onClick function to use
                if (this.onClick == 'trash')
                {
                    this.trash();
                }
                else if (this.onClick == 'reset')
                {
                    this.resetItems();
                }
            },
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
            },
            resetItems() {
                //Create AJAX post
                axios.post('/boodschappen/reset').then((res) => {

                    //Clear the groceries array
                    this.$root.groceries = [];
                });
            }
        }
    }
</script>
<style>
.shadow {
    height: 100%;
    position: fixed;
    width: 100%;
    background: black;
    opacity: 0.6;
    z-index: 2;
    top: 0;
    left: 0;
}

.messageContainer {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 5;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
}

.message {
    height: auto;
    width: 250px;
    background-color: #fff;
    border-radius: 2px;
    -webkit-box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
    -moz-box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
    box-shadow: 0px -1px 43px -7px rgba(0,0,0,0.1);
}

.messageHeader {
    height: 150px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #d9534f;
}

.circle {
    width: 70px;
    height: 70px;
    padding: 6px 0px;
    border-radius: 40px;
    font-size: 35px;
    line-height: 1.42857;
    color: #fff;
    border: 2px solid #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.title {
    display: block;
    width: fit-content;
    margin: 0 auto;
    padding-top: 24px;
    font-size: 1.1em;
    font-weight: bold;
}

.description {
    display: block;
    width: 200px;
    text-align: center;
    margin: 0 auto;
    padding-top: 20px;
}

.buttonContainer {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 8px;
    margin-top: 24px;
}

.confirmationButton {
    border-radius: 2px;
    -moz-user-select: none;
    -ms-user-select: none;
    outline: none;
    border: 0;
    -ms-flex-align: center;
    padding: 0 6px;
    line-height: 36px;
    min-height: 36px;
    background: transparent;
    min-width: 88px;
    text-transform: uppercase;
    cursor: pointer;
    transition: box-shadow 0.4s cubic-bezier(0.25, 0.8, 0.25, 1), background-color 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.confirmationButton:hover {
    background-color: rgba(158,158,158,0.2);
    text-decoration: none;
}

.confirmationButton span {
    color: rgb(63,81,181);
}
</style>