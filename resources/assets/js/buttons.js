$(document).ready(function(){
    $(document).on('click', '.complete', function()
    {
        $(this).toggleClass('completed');
        $(this).parent().toggleClass('done');
        $(this).closest('li').find('.hoeveelheid').toggleClass('checked');
        $(this).closest('li').find('.items').toggleClass('checked');
    });

    $(document).on('click', '.trashContainer', function(e)
    {
        if (e.target !== this)
        {
            return;
        }

        app.trash = false;
    });

    $('.reset').click(function(){
        app.confirmationMessage = true;
    })

    $('.delete').click(function(){
        app.trash = true;
    })
});