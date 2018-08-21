$(document).ready(function() {
    let url = window.location.href;
    let slug = url.split("/").pop();
    $.getJSON(base_url + "themes/get_theme/" + slug, loadTheme);

    function loadTheme(data) {
        if (data.theme.length > 0) {
            data.theme.forEach(function(d) {
                document.title = d.theme_name;
                $('.title h2 span').text(d.theme_name);
                $('#theme_body').html((lang == "id" && d.theme_body_id != '' && d.theme_body_id != null) ? (d.theme_body_id) : (d.theme_body != "" && d.theme_body != null) ? (d.theme_body) : (d.theme_body_id));
                $(".preview").attr("href", url + "/preview");
                $(".code").attr("href", d.theme_code);
                $(".image").attr("src", d.theme_image);
                $('.meta').text(d.theme_date);
            });

            if (data.cat.length > 0) {
                data.cat.forEach(function(d) {
                    $('.types').append("<a href='" + base_url + 'themes/' + d.slug + "'>" + d.category_name + "</a>,");
                });
            }
        } else {
            $('#posts').html("<center>Data not found</center>");
        }
        $('#bg, #container').show();
        $('#loader').hide();
    }
});