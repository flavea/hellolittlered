$(document).ready(() => {
    $.getJSON(`${base_url}projects/get_projects/`, loadProjects);

    function loadProjects(data) {
        let i = 1;
        if (data.length > 0) {
            data.forEach(d => {
                let temp = $('.listTemp').clone().removeClass('listTemp').show();
                $('.number', temp).text(i < 10 ? `0${i.toString()}` : i);
                $('a', temp).attr("data-target", `pr-${d.id}`);
                $('a', temp).text(d.name);
                $('span', temp).text(d.link);
                $('#projects-real').append(temp);
                let temp2 = $('.popupTemp').clone().removeClass('popupTemp').show().attr("id", `pr-${d.id}`);
                $('.number', temp2).text(i < 10 ? `0${i.toString()}` : i);
                $('.close', temp2).attr("data-target", `pr-${d.id}`);
                $('h2 a', temp2).text(d.name);
                $('h2 a', temp2).attr("href", d.link);
                $('img', temp2).attr("src", d.img);
                $('.desc', temp2).html((lang == "id" && d.exp_id != '' && d.exp_id != null) ? d.exp_id : (d.exp = "" && d.exp != null) ? d.exp : d.exp_id);
                $('#projects-real').append(temp2);
                i++;
            });
        } else {
            $('#projects-real').html("<center>Data not found</center>");
        }
        $('#bg, #container').show();
        $('#loader').hide();
    }
});