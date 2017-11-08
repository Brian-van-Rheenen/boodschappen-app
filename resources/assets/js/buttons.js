$(document).ready(function(){
    $(document).on('click', '.complete', function()
    {
        $(this).toggleClass('completed');
        $(this).parent().toggleClass('done');
        $(this).closest('li').find('.hoeveelheid').toggleClass('checked');
        $(this).closest('li').find('.items').toggleClass('checked');
    });

    $('.reset').click(function(){
        $('.shadow').show();
        $('.messageContainer').css('display', 'flex');
        $('.resetItems').show();
    })

    $('.confirmationButton').click(function(){
        $('.shadow').hide();
        $('.messageContainer').hide();
        $('.resetItems').hide();
        $('.saveItems').hide();
    })
});