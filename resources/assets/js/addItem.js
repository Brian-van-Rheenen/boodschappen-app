$(document).ready(function(){
    $('.add').click(function(event)
    {
        event.stopPropagation()
        $('.newItem').val('');
        $('.quantity').val('1');
        $('.addNewItem').toggleClass('hideAddItem');
    });
    $('html').click(function(event) {
        if($('.addNewItem').has('hideAddItem').length === 0 && !($(event.target).closest('.addNewItem').length)){
            $('.addNewItem').removeClass('hideAddItem');
        }
    });
});