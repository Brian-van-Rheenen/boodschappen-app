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
            <button type="button" class="btn btn-danger confirmationButton">Nee!</button>
            <button type="button" class="btn btn-success confirmationButton" v-on:click="this.$root.resetItems">Ja!</button>
        </div>
    </div>
</div>