<div class="shadow"></div>
<div class="messageContainer">
    <div class="message resetItems">
        <div class="messageHeader red">
            <i class="fa fa-times circle"></i>
        </div>
        <div class="messageDescription">
            <span class="title">{{ $goal }}</span>
            <span class="description">{{ $message }} <strong>{{ $action }}</strong> {{ $remaining }}</span>
        </div>
        <div class="buttonContainer">
            <button type="button" class="btn btn-danger confirmationButton">Nee!</button>
            <button type="button" class="btn btn-success confirmationButton" v-on:click={{ $onClick }}>Ja!</button>
        </div>
    </div>
</div>