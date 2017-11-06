$(document).ready(function(){
    /*
    $(window).click(function() {
        if($('.delete').hasClass( "delete-slide-in" ))
        {
            $('.delete').removeClass('delete-slide-in');
            $('.fa-trash-o').removeClass('white');
        }
    })*/

    $('.reset').click(function(){
        $('.shadow').show();
        $('.messageContainer').css('display', 'flex');
        $('.resetItems').show();
    })

    $('.save').click(function(){
        $('.shadow').show();
        $('.messageContainer').css('display', 'flex');
        $('.saveItems').show();
    })

    $('.confirmationButton').click(function(){
        $('.shadow').hide();
        $('.messageContainer').hide();
        $('.resetItems').hide();
        $('.saveItems').hide();
    })

    $('.complete').click(function(event)
    {
        $(this).toggleClass('completed');
        $(this).parent().toggleClass('done');
        $(this).closest('li').find('.hoeveelheid').toggleClass('checked');
        $(this).closest('li').find('.items').toggleClass('checked');
    });
});