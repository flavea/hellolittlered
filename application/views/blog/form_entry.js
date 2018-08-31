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

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            $('#table tbody').empty()
            site_data.categories.forEach(d => {
                let temp = $('.labTemp').clone().removeClass('labTemp').show()
                $('.checkbox', temp).val(d.category_id).attr('id', `cb-${d.category_id}`)
                $('.label', temp).text(d.category_name).attr('for', `cb-${d.category_id}`)
                $('#labels').append(temp)
            })
            $('#bg, #container, #table').show()
            $('#load').hide()
        }
    }

    checkData()

    if (slug != "/" && slug != "" && slug != "form_entry") {
        $.getJSON(`${base_url}blog/get_post/${slug}`, loadPosts)
        mode = "edit"

        function loadPosts(data) {
            if (data.post.length > 0) {
                data.post.forEach(d => {
                    $("#entry_name").val(d.entry_name)
                    $("#entry_name_id").val(d.entry_name_id)
                    $("#entry_image").val(d.entry_image)
                    $("#entry_video").val(d.entry_video)
                    $("#entry_tags").val(d.entry_tags)
                    $("#entry_body").val(d.entry_body)
                    $("#entry_body_id").val(d.entry_body_id)
                    $('.status[value="' + d.status + '"]').attr("checked", true)
                })

                if (data.cat.length > 0) {
                    data.cat.forEach(d => {
                        $('.checkbox[value="' + d.category_id + '"]').attr("checked", true)
                    })
                }
            } else {
                $('#posts').html("<center>Data not found</center>")
            }
            CKEDITOR.replace('entry_body')
            CKEDITOR.replace('entry_body_id')
        }
    } else {
        mode = "add"
        CKEDITOR.replace('entry_body')
        CKEDITOR.replace('entry_body_id')
    }

    $("#btnSubmit").click(e => {
        let val = []
        $(':checkbox:checked').each(function(i) {
            val[i] = $(this).val()
        })

        let url = ""
        let data = {
            entry_name: $("#entry_name").val(),
            entry_name_id: $("#entry_name_id").val(),
            entry_video: $("#entry_video").val(),
            entry_image: $("#entry_image").val(),
            entry_tags: $("#entry_tags").val(),
            entry_body: CKEDITOR.instances.entry_body.getData(),
            entry_body_id: CKEDITOR.instances.entry_body_id.getData(),
            entry_categories: val,
            tweet: $('#tweet').prop('checked') === true ? 1 : 0,
            status: $(".status:checked").val()
        }

        if (mode === "edit") url = `${base_url}blog/update_post/${slug}`
        else url = `${base_url}blog/add_post/`

        $.ajax({
            url: url,
            data,
            type: "POST",
            dataType: "JSON",
            success(ret) {
                showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                window.location.href = `${base_url}blog/form_entry/${id}`
            },
            error(ret) {
                showAlert("error", ret.statusText)
            }
        })
    })
})