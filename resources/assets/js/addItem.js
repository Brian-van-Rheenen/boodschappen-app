$(document).ready(function(){
    $('.add').click(function(event)
    {
        event.stopPropagation()
        app.resetForm();
        $('.addNewItem').toggleClass('hideAddItem');
    });
    $('html').click(function(event) {
        if($('.addNewItem').has('hideAddItem').length === 0 && !($(event.target).closest('.addNewItem').length)){
            app.resetForm();
            $('.ahGroupItem').hide();
            $('.addNewItem').removeClass('hideAddItem');
        }
    });
});