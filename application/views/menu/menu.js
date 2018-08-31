$(document).ready(() => {
    $('#bg, #container, #table').show()
    $('#load').hide()
    let mode = "add"
    let id = 0
    let url = window.location.href
    let slug = url.split("/").pop()
    let children

    $.getJSON(`${base_url}admin/get_statuses/`, loadStatuses)
    $.getJSON(`${base_url}menu/get_children/${slug}`, loadChildren)

    function loadStatuses(data) {
        if (data.length > 0) {
            data.forEach(d => {
                let temp = $('.statTemp').clone().removeClass('statTemp').show()
                $('.status', temp).val(d.id).attr('id', `status-${d.id}`)
                $('.label', temp).text(d.name).attr('for', `status-${d.id}`)
                $('#statuses').append(temp)
            })
            $('#bg, #container').show()
            $('#load').hide()
        } else $('#theme').html("<center>Data not found</center>")
    }

    function loadChildren(data) {
        if (data.length > 0) {
            children = data
            data.forEach(d => {
                let temp = $('.tableTemp').clone().removeClass('tableTemp').show()
                $(".pr", temp).text(d.priority)
                $(".name", temp).text(d.menu_en)
                $(".link", temp).text(d.link)
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
            $('#table').show()
            $('#load').hide()
        } else $('#table').hide()
    }

    function reinit() {
        $("#btnReset").click()
        $('#table, #table_wrapper').hide()
        $('#load').show()
        if ($.fn.DataTable.isDataTable('#table')) {
            $('#table').dataTable().fnClearTable()
            $('#table').dataTable().fnDestroy()
        }
        $.getJSON(`${base_url}menu/get_children/${slug}`, loadChildren)
    }

    $('html').on('click', '.fa-edit', function(event) {
        id = $(this).attr("mid")
        mode = "edit"
        children.forEach(d => {
            if (d.id == id) {
                $('#menu_en').val(d.menu_en)
                $('#menu_id').val(d.menu_id)
                $('#link').val(d.link)
                $('#priority').val(d.priority)
                $('.admin').attr("checked", d.admin == 1 ? true : false)
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
                url: `${base_url}menu/delete_menu/${id}`,
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
        $('#menu_en, #menu_id, #link, #priority').val("")
        $('.status, .admin').attr("checked", false)
        $('#btnSubmit').val("Add")
        id = 0
        mode = "add"
    })

    $("#btnSubmit").click(e => {
        let data = {
            menu_en: $("#menu_en").val(),
            menu_id: $("#menu_id").val(),
            link: $("#link").val(),
            priority: $("#priority").val(),
            parent: slug,
            admin: $('.admin').prop('checked') === true ? 1 : 0,
            status: $(".status:checked").val()
        }

        let url = ""
        if (mode === "edit") url = `${base_url}menu/update_menu/${id}`
        else url = `${base_url}menu/add_menu`

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