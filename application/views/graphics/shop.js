$(document).ready(function() {
    $.getJSON(base_url + "shop/get_store_items/", loadShop);

    function loadShop(data) {
        if (data.length > 0) {
            data.forEach(function(d) {
                let temp = $('.shopTemp').clone().removeClass('shopTemp').show();
                $('.redbubble', temp).attr('href', d.redbubble)
                $('.tees', temp).attr('href', d.tees)
                $('img', temp).attr('src', d.image)
                $('h3', temp).text(d.name);
                $('#theme').append(temp);
            });
            $('#bg, #container').show();
            $('#loader').hide();
        } else $('#theme').html("<center>Data not found</center>");

        $('#friends-loader').hide();
    }

});