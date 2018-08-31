$(document).ready(() => {
    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            $('#table tbody').empty()
            site_data.pages.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $(".name", temp).text(d.page_title)
                $(".id", temp).text(d.page_id)
                $(".fa", temp).attr("mid", d.page_id)
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

    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        window.location.href = `${base_url}pages/form_page/${id}`
    })

    $('html').on('click', '.fa-trash', function(event) {
        id = $(this).attr("mid")
        let conf = confirm("Are you sure you want to delete this?")
        if (conf) {
            $.ajax({
                url: `${base_url}pages/delete_page/${id}`,
                type: "POST",
                dataType: "JSON",
                success(ret) {
                    showAlert(ret.status, ret.message)
                    $("#load").show()
                    $.getJSON(link, loadPosts)
                }
            })
        }
    })
})