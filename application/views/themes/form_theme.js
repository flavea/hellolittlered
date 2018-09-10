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
            site_data.theme_categories.forEach(d => {
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

    if (slug != "/" && slug != "" && slug != "form_theme") {
        $.getJSON(`${base_url}themes/get_theme/${slug}`, loadThemes)
        mode = "edit"

        function loadThemes(data) {
            if (data.theme.length > 0) {
                data.theme.forEach(d => {
                    $("#theme_name").val(d.theme_name)
                    $("#theme_image").val(d.theme_image)
                    $("#theme_code").val(d.theme_code)
                    $("#theme_body").val(d.theme_body)
                    $("#theme_body_id").val(d.theme_body_id)
                    $('.status[value="' + d.status + '"]').attr("checked", true)
                })

                if (data.cat.length > 0) {
                    data.cat.forEach(d => {
                        $('.checkbox[value="' + d.category_id + '"]').attr("checked", true)
                    })
                }

                $("#theme_preview").val(data.code)
            } else {
                $('#posts').html("<center>Data not found</center>")
            }
            CKEDITOR.replace('theme_body')
            CKEDITOR.replace('theme_body_id')
        }
    } else {
        mode = "add"
        CKEDITOR.replace('theme_body')
        CKEDITOR.replace('theme_body_id')
    }

    $("#btnSubmit").click(e => {
        let val = []
        $(':checkbox:checked').each(function(i) {
            val[i] = $(this).val()
        })

        let data = {
            theme_name: $("#theme_name").val(),
            theme_preview: $("#theme_preview").val(),
            theme_image: $("#theme_image").val(),
            theme_code: $("#theme_code").val(),
            theme_body: CKEDITOR.instances.theme_body.getData(),
            theme_body_id: CKEDITOR.instances.theme_body_id.getData(),
            theme_category: val,
            tweet: $('#tweet').prop('checked') === true ? 1 : 0,
            status: $(".status:checked").val()
        }

        let url = ""

        if (mode === "edit") url = `${base_url}tema/update_theme/${slug}`
        else url = `${base_url}tema/add_theme/`

        $.ajax({
            url: url,
            data,
            type: "POST",
            dataType: "JSON",
            success(ret) {
                showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                reinit()
            },
            error(ret) {
                showAlert("error", ret.statusText)
            }
        })
    })
})