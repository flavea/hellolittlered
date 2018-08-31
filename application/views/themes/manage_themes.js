$(document).ready(() => {
    let url = window.location.href;
    let slug = url.split("/").pop();
    if (slug == "themes" || slug == "") {
        function checkData() {
            if (typeof site_data === "undefined") {
                setTimeout(checkData, 50)
            } else {
                site_data.theme_categories.forEach(d => {
                    let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                    $(".id", temp).html(d.category_id)
                    $(".slug", temp).text(d.slug)
                    $(".name", temp).text(d.category_name)
                    $(".fa", temp).attr("mid", d.category_id)
                    $('#table tbody').append(temp)
                })
                $('#table').DataTable({
                    "autoWidth": false
                })
                $('.previous').removeClass('previous')
                $('.next').removeClass('next')
                $('.current').addClass('button-inverse')
                $('.paginate_button').removeClass('paginate_button').addClass('button')
                $('#table_wrapper').addClass('post')
                $('#bg, #container, #table').show()
                $('#load').hide()
            }
        }

        checkData()
    } else {
        $.getJSON(`${base_url}themes/get_themes_by_slug/${slug}`, loadThemes);

        function loadThemes(data) {
            if (data.length > 0) {
                if ($.fn.DataTable.isDataTable('#table')) {
                    $('#table').dataTable().fnClearTable();
                    $('#table').dataTable().fnDestroy();
                }
                $("#table tbody").empty();
                data.forEach(d => {
                    let temp = $('.tableTemp').clone().removeClass('tableTemp').show();
                    $('.fa', temp).attr('mid', d.theme_id)
                    $('.id', temp).text(d.theme_id)
                    $('.name', temp).text(d.theme_name);
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

            } else
                $('#entries').html("<center>Data not found</center>");;

            $('#bg, #container').show();
            $('#load, #posts-loader').hide();
        }

        $('html').on('click', '.fa-edit', function(event) {
            id = $(this).attr("mid")
            window.location.href = `${base_url}themes/form_theme/${id}`
        })

        $('html').on('click', '.fa-trash', function(event) {
            id = $(this).attr("mid")
            let conf = confirm("Are you sure you want to delete this?");
            if (conf) {
                $.ajax({
                    url: `${base_url}themes/delete_theme/${id}`,
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
    }
})