$(document).ready(() => {
    let designs
    let mode = "add"
    $.getJSON(`${base_url}shop/get_store_items/`, loadDesigns)
    $.getJSON(`${base_url}admin/get_statuses/`, loadStatuses)

    function loadStatuses(data) {
        if (data.length > 0) {
            data.forEach(d => {
                let temp = $('.statTemp').clone().removeClass('statTemp').show()
                $('.status', temp).val(d.id).attr('id', `status-${d.id}`)
                $('.label', temp).text(d.name).attr('for', `status-${d.id}`)
                $('#statuses').append(temp)
            })
        }
    }

    function loadDesigns(data) {
        designs = data
        if (data.length > 0) {
            $('#table tbody').empty()
            data.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $('img', temp).attr('src', d.image)
                $('.name', temp).text(d.name)
                $('.fa', temp).attr("mid", d.id)
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
        } else $('.post').html("<center>Data not found</center>")
    }


    function reinit() {
        $("#btnReset").click()
        $('#table, #table_wrapper').hide()
        $('#load').show()
        if ($.fn.DataTable.isDataTable('#table')) {
            $('#table').dataTable().fnClearTable()
            $('#table').dataTable().fnDestroy()
        }
        $.getJSON(`${base_url}shop/get_store_items/`, loadDesigns)
    }

    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        mode = "edit"
        designs.forEach(d => {
            if (d.id == id) {
                $('#name').val(d.name)
                $('#timage').val(d.image)
                $('#redbubble').val(d.redbubble)
                $('#tees').val(d.tees)
                $('.status[value="' + d.status + '"]').attr("checked", true)
                $('#btnSubmit').val("Update")
            }
        })
        $("html, body").animate({ scrollTop: 0 }, "slow")
    })

    $('html').on('click', '.fa-trash', function(event) {
        id = $(this).attr("mid")
        let conf = confirm("Are you sure you want to delete this?")
        if (conf) {
            $.ajax({
                url: `${base_url}friends/delete_friend/${id}`,
                type: "POST",
                dataType: "JSON",
                success(ret) {
                    showAlert(ret.status, ret.message)
                    reinit()
                }
            })
        }
    })

    $("#btnReset").click(e => {
        $('#name, #timage, #redbubble, #tees').val("")
        $('.status').attr("checked", false)
        $('#btnSubmit').val("Add")
        id = 0
        mode = "add"
    })

    $("#btnSubmit").click(e => {
        if ($("#name").val() == null || $("#name").val() == "") showAlert("Error", "Sidebar name can't be empty!")
        else if ($("#timage").val() == null || $("#timage").val() == "") showAlert("Error", "Image content can't be empty!")
        else {
            let data = {
                name: $("#name").val(),
                image: $("#timage").val(),
                tees: $("#tees").val(),
                redbubble: $("#redbubble").val(),
                tweet: $('#tweet').prop('checked') === true ? 1 : 0,
                status: $(".status:checked").val()
            }

            let url = ""

            if (mode === "edit") url = `${base_url}graphics/update_design/${id}`
            else url = `${base_url}graphics/add_design/`

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
        }
    })

})