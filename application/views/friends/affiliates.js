$(document).ready(() => {
    $.getJSON(`${base_url}friends/get_friends/`, loadFriends);

    function loadFriends(data) {
        if (data.length > 0) {
            $('.friends').empty();
            let i = 1;
            data.forEach(d => {
                let temp = $('.affTemp').clone().removeClass('affTemp').show();
                $('.number', temp).text(i < 10 ? `0${i.toString()}` : i);
                $('a', temp).attr('href', d.website)
                $('a', temp).text(d.name);
                $('span', temp).text(d.description);
                $('.friends').append(temp);
                i++
            });
            $('#bg, #container').show();
            $('#loader').hide();
        } else $('.friends').html("<center>Data not found</center>");

        $('#friends-loader').hide();
    }

});