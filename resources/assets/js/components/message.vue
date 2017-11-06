<template>
    <div>
        <div class="shadow"></div>
        <div class="messageContainer">
            <div class="message resetItems">
                <div class="messageHeader red">
                    <i class="fa fa-times circle"></i>
                </div>
                <div class="messageDescription">
                    <span class="title">Reset?</span>
                    <span class="description">Weet je zeker dat je alle boodschappen wilt resetten? Dit <strong>verwijdert</strong> ze allemaal.</span>
                </div>
                <div class="buttonContainer">
                    <button type="button" class="btn btn-success confirmationButton">Ja!</button>
                    <button type="button" class="btn btn-danger confirmationButton">Nee!</button>
                </div>
            </div>
            <div class="message saveItems">
                <div class="messageHeader green">
                    <i class="fa fa-check circle"></i>
                </div>
                <div class="messageDescription">
                    <span class="title">Opslaan?</span>
                    <span class="description">Weet je zeker dat je alle boodschappen wilt opslaan? Dit is niet terug te draaien.</span>
                </div>
                <div class="buttonContainer">
                    <button type="button" class="btn btn-success confirmationButton">Ja!</button>
                    <button type="button" class="btn btn-danger confirmationButton">Nee!</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'message',
        data() {
            return {

            }
        }
    }
</script>