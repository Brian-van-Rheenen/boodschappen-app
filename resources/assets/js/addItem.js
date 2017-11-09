$(document).ready(function(){
    $('.add').click(function(event)
    {
        event.stopPropagation()
        $('.newItem').val('');
        $('.quantity').val('');
        $('.addNewItem').toggleClass('hideAddItem');
    });
    /*
    $('.newItem').keyup(function() {
        axios.get('https://www.ah.nl/service/rest/delegate?url=/zoeken?rq=' + $(this).val() + '&searchType=product&_=1510216828382').then((res) => {

            var response = res.data['_embedded']['lanes'][6]['_embedded']['items'];
            response.pop();

            for (var k in response)
            {
                //console.log(response[k]['_embedded']['product']['description'] ,k);
            }
        });
    })
    */
    $('html').click(function(event) {
        if($('.addNewItem').has('hideAddItem').length === 0 && !($(event.target).closest('.addNewItem').length)){
            $('.addNewItem').removeClass('hideAddItem');
        }
    });
});