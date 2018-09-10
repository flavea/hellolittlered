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
            site_data.resources.forEach(d => {
                let temp = $('.labTemp').clone().removeClass('labTemp').show()
                $('.checkbox', temp).val(d.type_id).attr('id', `cb-${d.type_id}`)
                $('.label', temp).text(d.type_name).attr('for', `cb-${d.type_id}`)
                $('#labels').append(temp)
            })
            $('#bg, #container, #table').show()
            $('#load, #loader').hide()
        }
    }

    checkData()

    if (slug != "/" && slug != "" && slug != "form_entry") {
        $.getJSON(`${base_url}resource/get_resource/${slug}`, loadPosts)
        mode = "edit"

        function loadPosts(data) {
            if (data.length > 0) {
                data.forEach(d => {
                    $("#resource_name").val(d.resource_name)
                    $("#resource_preview").val(d.resource_preview)
                    $("#resource_download").val(d.resource_download)
                    $('.status[value="' + d.status + '"]').attr("checked", true)
                    $('.checkbox[value="' + d.resource_type + '"]').attr("checked", true)
                })

            } else {
                $('#posts').html("<center>Data not found</center>")
            }
        }
    } else {
        mode = "add"
    }

    $("#btnSubmit").click(e => {
        let data = {
            resource_name: $("#resource_name").val(),
            resource_preview: $("#resource_preview").val(),
            resource_download: $("#resource_download").val(),
            resource_category: $(".checkbox:checked").val(),
            status: $(".status:checked").val()
        }

        let url = ""

        if (mode === "edit") url = `${base_url}resource/update_resource/${slug}`
        else url = `${base_url}resource/add_resource/`

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