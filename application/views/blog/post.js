$(document).ready(function() {
    let url = window.location.href;
    let slug = url.split("/").pop();
    $.getJSON(base_url + "blog/get_post/" + slug, loadPosts);

    function loadPosts(data) {
        if (data.post.length > 0) {
            data.post.forEach(function(d) {
                document.title = (lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id;
                $('.title h2').text((lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id);
                $('#entry_body').html((lang == "id" && d.entry_body_id != '' && d.entry_body_id != null) ? (d.entry_body_id) : (d.entry_body != "" && d.entry_body != null) ? (d.entry_body) : (d.entry_body_id));
                $('.meta').text(d.entry_date);
                if (d.entry_image != null && d.entry_image != "") $('#img').append("<img src='" + d.entry_image + "'>");
                if (d.entry_video != null && d.entry_video != "") $('#img').append(d.entry_video);
            });

            if (data.cat.length > 0) {
                data.cat.forEach(function(d) {
                    $('.categories').append("<a href='" + base_url + 'category/' + d.slug + "'>" + d.category_name + "</a>,");
                });
            }
        } else {
            $('#posts').html("<center>Data not found</center>");
        }
        $('#bg, #container').show();
        $('#loader').hide();
    }
});