$(document).ready(() => {
    let mode = ""
    let url = window.location.href
    let slug = url.split("/").pop()

    $.getJSON(`${base_url}admin/get_statuses/`, loadStatuses)

    function loadStatuses(data) {
        if (data.length > 0) {
            data.forEach(d => {
                let temp = $('.statTemp').clone().removeClass('statTemp').show()
                $('.status', temp).val(d.id).attr('id', `status-${d.id}`)
                $('.label', temp).text(d.name).attr('for', `status-${d.id}`)
                $('#statuses').append(temp)
            })
            $('#bg, #container').show()
            $('#loader').hide()
        }
    }

    if (slug != "/" && slug != "" && slug != "form_page") {
        $.getJSON(`${base_url}pages/get_page_by_id/${slug}`, loadPosts)
        mode = "edit"

        function loadPosts(data) {
            if (data.length > 0) {
                data.forEach(d => {
                    $("#page_name").val(d.page_title)
                    $("#page_name_id").val(d.page_title_id)
                    $("#page_slug").val(d.slug)
                    $("#page_body").val(d.page_body)
                    $("#page_body_id").val(d.page_body_id)
                    $('.status[value="' + d.status + '"]').attr("checked", true)
                })

            } else {
                $('#posts').html("<center>Data not found</center>")
            }
            CKEDITOR.replace('page_body')
            CKEDITOR.replace('page_body_id')
        }
    } else {
        mode = "add"
        CKEDITOR.replace('page_body')
        CKEDITOR.replace('page_body_id')
    }

    $("#btnSubmit").click(e => {
        let val = []
        $(':checkbox:checked').each(function(i) {
            val[i] = $(this).val()
        })

        let url = ""
        let data = {
            page_title: $("#page_name").val(),
            page_title_id: $("#page_name_id").val(),
            page_slug: $("#page_slug").val(),
            page_body: CKEDITOR.instances.page_body.getData(),
            page_body_id: CKEDITOR.instances.page_body_id.getData(),
            tweet: $('#tweet').prop('checked') === true ? 1 : 0,
            status: $(".status:checked").val()
        }

        if (mode === "edit") url = `${base_url}pages/update_page/${slug}`
        else url = `${base_url}pages/add_page/`

        $.ajax({
            url: url,
            data,
            type: "POST",
            dataType: "JSON",
            success(ret) {
                showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
            },
            error(ret) {
                showAlert("error", ret.statusText)
            }
        })
    })
})