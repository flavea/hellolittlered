$(document).ready(() => {
    let url = window.location.href;
    let slug = url.split("/").pop();
    if (slug == "themes" || slug == "") slug = "all";
    $.getJSON(`${base_url}themes/get_themes_by_slug/${slug}`, loadThemes);

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50);
        } else {
            site_data.basic.forEach(d => {
                $("#tou").html((lang == "id" && d.tou_id != '' && d.tou_id != null) ? d.tou_id : (d.tou != "" && d.tou != null) ? d.tou : d.tou_id);
                $("#tou-title").html((lang == "id") ? "Aturan Penggunaan" : "Terms of Use");
            });
            site_data.theme_categories.forEach(d => {
                let temp = $('.catTemp').clone().removeClass('catTemp').show();
                $(temp).attr('theme', d.slug)
                $(temp).text(d.category_name);
                if (d.slug == slug) $(temp).addClass('theme_current');
                $('#theme-categories').append(temp);
            });
            $('#bg, #container').show();
            $('#loader').hide();
        }
    }

    checkData();

    function loadThemes(data) {
        if (data.length > 0) {
            $('#loadThemes').empty();
            data.forEach(d => {
                let temp = $('.themeTemp').clone().removeClass('themeTemp').addClass('mini-theme').show();
                $('.image, h5 a', temp).attr('href', `${base_url}theme/${d.theme_id}`)
                $('.preview', temp).attr('href', `${base_url}theme/${d.theme_id}/preview`)
                $('.code', temp).attr('href', d.code)
                $('.image img', temp).attr('src', d.theme_image)
                $('h5 a', temp).text(d.theme_name);
                $('#loadThemes').append(temp);
            });
        } else $('#loadThemes').html("<center>Data not found</center>");

        $('#theme-loader').hide();
    }

    $('#theme-categories').on('click', 'a', function(event) {
        let slug = $(this).attr("theme");
        $('#loadThemes').empty();
        $('#theme-loader').show();
        $('#theme-categories a').removeClass("theme_current");
        $(this).addClass("theme_current");
        window.history.pushState(null, null, `${base_url}themes/${slug}`);
        $.getJSON(`${base_url}themes/get_themes_by_slug/${slug}`, loadThemes);
    });
});