$(document).ready(() => {
    let url = window.location.href;
    let slug = url.split("/").pop();
    if (slug == "blog") slug = 0;

    $.getJSON(`${base_url}blog/get_posts/${slug}`, loadPosts);

    function loadPosts(data) {
        if (data.posts.length > 0) {
            if ($.fn.DataTable.isDataTable('#table')) {
                $('#table').dataTable().fnClearTable();
                $('#table').dataTable().fnDestroy();
            }
            $("#table tbody").empty();
            data.posts.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show();
                $('.fa', temp).attr('mid', d.entry_id)
                $('.id', temp).text(d.entry_id)
                $('.name', temp).text((lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id);
                $('#table tbody').append(temp);
            });
            $('#table').DataTable({
                "autoWidth": false
            });
            $('.previous').removeClass('previous')
            $('.next').removeClass('next')
            $('.current').addClass('button-inverse');
            $('.paginate_button').removeClass('paginate_button').addClass('button');
            $('#table_wrapper').addClass('post');
            $('#bg, #container, #table').show();
            $('#load').hide();

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
        $('#load, #posts-loader').hide();
    }

    $('.pagination').on('click', 'a', function(event) {
        let link = $(this).attr("post-target");
        $("#load").show();
        $.getJSON(link, loadPosts);
        window.history.pushState(null, null, `${base_url}blog/manage_posts/${link.split("/").pop()}`);
    });


    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        window.location.href = `${base_url}blog/form_entry/${id}`
    })

    $('html').on('click', '.fa-trash', function(event) {
        id = $(this).attr("mid")
        let conf = confirm("Are you sure you want to delete this?");
        if (conf) {
            $.ajax({
                url: `${base_url}blog/delete_post/${id}`,
                type: "POST",
                dataType: "JSON",
                success(ret) {
                    showAlert(ret.status, ret.message)
                    $("#load").show();
                    $.getJSON(link, loadPosts);
                }
            })
        }
    })
})