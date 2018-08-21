$(document).ready(function() {
    $.getJSON(base_url + "site/get_front_data", loadFrontData);

    function loadFrontData(data) {
        if (data.posts.length > 0) {
            $('.tagged').text(lang == "id" ? 'Post Blog' : 'Blog Posts');
            data.posts.forEach(function(d) {
                let temp = $('.tempBlog').clone().removeClass('tempBlog').addClass('mini-theme').show();
                $('a', temp).attr('href', base_url + 'post/' + d.entry_id)
                $('h4', temp).text((lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id);
                $('.date', temp).text(d.entry_date);
                $('.left').append(temp);
            });
        } else $('#posts').hide();

        if (data.themes.length > 0) {
            $('#themes h1 span').text(lang == "id" ? 'Tema Terbaru' : 'Latest Themes');
            data.themes.forEach(function(d) {
                let temp = $('.themeTemp').clone().removeClass('themeTemp').show();
                $('a', temp).attr('href', base_url + 'theme/' + d.theme_id)
                $('img', temp).attr('src', d.theme_image)
                $('h6', temp).text(d.theme_name);
                $('#themes > div').append(temp);
            });
        } else $('#themes').hide();

        if (data.project.length > 0) {
            $('#projects h1 span').text(lang == "id" ? 'Proyek Terbaru' : 'Latest Project');
            data.project.forEach(function(d) {
                $('#project-image img').attr("src", d.img);
                $('.inside-project h2').text(d.name);
                $('.inside-project p').html((lang == "id" && d.exp_id != '' && d.exp_id != null) ? d.exp_id : (d.exp = "" && d.exp != null) ? d.exp : d.exp_id);
            });
        } else $('#projects').hide();


        if (data.exp.length > 0) {
            $('#experiments h1 span').text(lang == "id" ? 'Eksperimen Terbaru' : 'Latest Experiments');
            data.exp.forEach(function(d) {
                let temp = $('.expTemp').clone().removeClass('expTemp').show();
                $('a', temp).attr('href', base_url + 'theme/' + d.theme_id);
                $('.previewLink', temp).attr('href', d.link);
                $('.codeLink', temp).attr('href', d.code);
                $('img', temp).attr('src', d.image);
                $('h4 > span', temp).text((lang == "id" && d.name_id != '' && d.name_id != null) ? d.name_id : (d.name != "" && d.name != null) ? d.name : d.name_id);
                $('p', temp).html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description = "" && d.description != null) ? d.description : d.description_id);
                $('#experiments > div').append(temp);
            });
        } else {
            $('#experiments').hide();
        }

        $('#bg, #container').show();
        $('#loader').hide();
    }
});