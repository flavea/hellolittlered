$(document).ready(() => {
    $.getJSON(`${base_url}lab/get_exps`, loadFrontData);

    function loadFrontData(data) {
        if (data.length > 0) {
            data.forEach(d => {
                let temp = $('.expTemp').clone().removeClass('expTemp').show();
                $('a', temp).attr('href', `${base_url}theme/${d.theme_id}`);
                $('.previewLink', temp).attr('href', d.link);
                $('.codeLink', temp).attr('href', d.code);
                $('img', temp).attr('src', d.image);
                $('h4 > span', temp).text((lang == "id" && d.name_id != '' && d.name_id != null) ? d.name_id : (d.name != "" && d.name != null) ? d.name : d.name_id);
                $('p', temp).html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description = "" && d.description != null) ? d.description : d.description_id);
                $('.content-real').append(temp);
            });
        } else {
            $('.content-real').hide();
        }

        $('#bg, #container').show();
        $('#loader').hide();
    }
});