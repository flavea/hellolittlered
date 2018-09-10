$(document).ready(() => {

    $.getJSON(`${base_url}commission/get_commissions/`, loadPosts);

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
            $('#load, #loader').hide();

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
})