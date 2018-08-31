$(document).ready(() => {
    let url = window.location.href;
    let slug = url.split("/").pop();
    if (slug == "resources" || slug == "") slug = "all";
    $.getJSON(`${base_url}resource/get_resources_by_slug/${slug}`, loadresources);

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50);
        } else {
            site_data.basic.forEach(d => {
                $("#tou").html((lang == "id" && d.tou_id != '' && d.tou_id != null) ? d.tou_id : (d.tou != "" && d.tou != null) ? d.tou : d.tou_id);
                $("#tou-title").html((lang == "id") ? "Aturan Penggunaan" : "Terms of Use");
            });
            site_data.resources.forEach(d => {
                let temp = $('.catTemp').clone().removeClass('catTemp').show();
                $(temp).attr('resource', d.type_slug)
                $(temp).text(d.type_name);
                if (d.type_slug == slug) $(temp).addClass('theme_current');
                $('#theme-categories').append(temp);
            });
            $('#bg, #container').show();
            $('#loader').hide();
        }
    }

    checkData();

    function loadresources(data) {
        if (data.length > 0) {
            $('#loadresources').empty();
            data.forEach(d => {
                let temp = $('.resourceTemp').clone().removeClass('resourceTemp').addClass('mini-resource').show();
                $('.download', temp).attr('href', d.resource_download)
                $('img', temp).attr('src', d.resource_preview)
                $('h5', temp).text(d.resource_name);
                $('#loadresources').append(temp);
            });
        } else $('#loadresources').html("<center>Data not found</center>");

        $('#resource-loader').hide();
    }

    $('#theme-categories').on('click', 'a', function(event) {
        let slug = $(this).attr("resource");
        $('#loadresources').empty();
        $('#resource-loader').show();
        $('#theme-categories a').removeClass("theme_current");
        $(this).addClass("theme_current");
        window.history.pushState(null, null, `${base_url}resource/${slug}`);
        $.getJSON(`${base_url}resource/get_resources_by_slug/${slug}`, loadresources);
    });
});