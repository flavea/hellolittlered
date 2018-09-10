$(document).ready(() => {
    $.getJSON(`${base_url}resource/get_resources/`, loadResources)

    function loadResources(data) {
        if (data.length > 0) {
            if ($.fn.DataTable.isDataTable('#table')) {
                $('#table').dataTable().fnClearTable()
                $('#table').dataTable().fnDestroy()
            }
            $("#table tbody").empty()
            data.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $('.fa', temp).attr('mid', d.resource_id)
                $('.id', temp).text(d.resource_id)
                $('.name', temp).text(d.resource_name)
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
            $('#load, #loader').hide()

        } else
            $('#entries').html("<center>Data not found</center>")

    }

    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        window.location.href = `${base_url}resource/form_resource/${id}`
    })

    $('html').on('click', '.fa-trash', function(event) {
        id = $(this).attr("mid")
        let conf = confirm("Are you sure you want to delete this?")
        if (conf) {
            $.ajax({
                url: `${base_url}resource/delete_resource/${id}`,
                type: "POST",
                dataType: "JSON",
                success(ret) {
                    showAlert(ret.status, ret.message)
                    $("#load").show()
                    $.getJSON(`${base_url}resource/get_resources/`, loadResources)
                }
            })
        }
    })


    $('#bg, #container').show()
    $('#load, #posts-loader').hide()
})