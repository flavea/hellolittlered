$(document).ready(() => {
    let mode = "add"
    let id = 0
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
        } else $('#theme').html("<center>Data not found</center>")

        $('#friends-loader').hide()
    }

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            $('#table tbody').empty()
            site_data.sidebars.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $(".name", temp).text(d.name)
                $(".fa", temp).attr("mid", d.id)
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


    function reinit() {
        $("#btnReset").click()
        $('#table, #table_wrapper').hide()
        $('#load').show()
        if ($.fn.DataTable.isDataTable('#table')) {
            $('#table').dataTable().fnClearTable()
            $('#table').dataTable().fnDestroy()
        }
        $.getJSON(`${base_url}site/get_data`, data => {
            site_data = data
            checkData()
        })
    }

    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        mode = "edit"
        site_data.sidebars.forEach(d => {
            if (d.id == id) {
                $('#name').val(d.name)
                $('#textarea').val(d.content)
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
                url: `${base_url}admin/delete_sidebar/${id}`,
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
        $('#name, #textarea').val("")
        $('.status').attr("checked", false)
        $('#btnSubmit').val("Add")
        id = 0
        mode = "add"
    })

    $("#btnSubmit").click(e => {
        if ($("#name").val() == null || $("#name").val() == "") showAlert("Error", "Sidebar name can't be empty!")
        else if ($("#textarea").val() == null || $("#textarea").val() == "") showAlert("Error", "Siderbar content can't be empty!")
        else {
            let data = {
                name: $("#name").val(),
                content: $("#textarea").val(),
                status: $(".status:checked").val()
            }

            let url = ""
            if (mode === "edit") url = `${base_url}admin/sidebar/${id}`
            else url = `${base_url}admin/add_sidebar`

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