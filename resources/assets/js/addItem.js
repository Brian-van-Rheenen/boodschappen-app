$(document).ready(function(){
    $('.add').click(function(event)
    {
        if ($('.add').hasClass('btn-success'))
        {
            app.addItem();
        }
        event.stopPropagation()
        app.resetForm();
        $('.addNewItem').addClass('hideAddItem');
        $(".newItem").focus();
        $(this).removeClass('btn-primary').addClass('btn-success');
        $(this).children().removeClass('fa-plus').addClass('fa-check');
    });
    $('html').click(function(event) {
        if($('.addNewItem').has('hideAddItem').length === 0 && !($(event.target).closest('.addNewItem').length)){
            app.resetForm();
            $('.ahGroupItem').hide();
            $('.addNewItem').removeClass('hideAddItem');
            $('.add').removeClass('btn-success').addClass('btn-primary');
            $('.add').children().removeClass('fa-check').addClass('fa-plus');
        }
    });
});

