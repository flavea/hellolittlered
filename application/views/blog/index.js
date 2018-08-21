$(document).ready(function() {
    let url = window.location.href;
    let slug = url.split("/").pop();
    if (slug == "blog") slug = 0;

    $.getJSON(base_url + "blog/get_posts/" + slug, loadPosts);

    function loadPosts(data) {
        if (data.posts.length > 0) {
            $("#entries").empty();
            data.posts.forEach(function(d) {
                let temp = $('.postTemp').clone().removeClass('postTemp').show();
                $('.title h2 a', temp).attr('href', base_url + 'post/' + d.entry_id)
                $('.button', temp).attr('href', base_url + 'post/' + d.entry_id)
                $('.title h2 a', temp).text((lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id);
                $('.entry_body', temp).html((lang == "id" && d.entry_body_id != '' && d.entry_body_id != null) ? (d.entry_body_id).substring(0, 300) + "..." : (d.entry_body != "" && d.entry_body != null) ? (d.entry_body).substring(0, 300) + "..." : (d.entry_body_id).substring(0, 300) + "...");
                $('.meta', temp).text(d.entry_date);
                if (d.entry_image != null && d.entry_image != "") $('#img', temp).append("<img src='" + d.entry_image + "'>");
                if (d.entry_video != null && d.entry_video != "") $('#img', temp).append(d.entry_video);
                $('#entries').append(temp);
            });


            $('.pagination').html(data.pagination);
            $('.pagination a').each(function() {
                let link = $(this).attr("href");
                $(this).removeAttr("href");
                $(this).attr("post-target", link);
            });
            $("pagination li span a").addClass("button big");
        } else
            $('#entries').html("<center>Data not found</center>");;

        $('#bg, #container').show();
        $('#loader, #posts-loader').hide();
    }

    $('.pagination').on('click', 'a', function(event) {
        let link = $(this).attr("post-target");
        $("#entries").empty();
        $("#posts-loader").show();
        $.getJSON(link, loadPosts);
        window.history.pushState(null, null, base_url + "blog/" + link.split("/").pop());
    });
});