$(document).ready(() => {
    let mode = "add"
    let id = 0

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.resources.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $(".id", temp).text(d.type_id)
                $(".slug", temp).text(d.type_slug)
                $(".name", temp).text(d.type_name)
                $(".fa", temp).attr("mid", d.type_id)
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
        site_data.resources.forEach(d => {
            if (d.type_id == id) {
                $('#txtName').val(d.type_name)
                $('#txtSlug').val(d.type_slug)
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
                url: `${base_url}resource/delete_category/${id}`,
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
        $('#txtName, #txtSlug').val("")
        $('#btnSubmit').val("Add")
        id = 0
        mode = "add"
    })

    $("#btnSubmit").click(e => {
        if ($("#txtName").val() == null || $("#txtName").val() == "") showAlert("Error", "Category name can't be empty!")
        else {
            let data = {
                category_name: $("#txtName").val(),
                category_slug: $("#txtSlug").val(),
            }

            let url = ""

            if (mode === "edit") url = `${base_url}resource/update_category/${id}`
            else url = `${base_url}resource/add_category/`

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