$(document).ready(function() {
    $.getJSON(base_url + "commission/get_categories", loadCategories)

    function loadCategories(data) {
        if (data.length > 0) {
            data.forEach(function(d) {

                let temp = $('.chkTemp').clone().removeClass('chkTemp').show()
                $('.chk', temp).attr('value', d.category_id)
                $('.category', temp).text(d.category_name)
                $('.base_price', temp).text(d.base_price)
                $('small', temp).html((lang == "id" && d.desription_ind != '' && d.desription_ind != null) ? d.desription_ind :
                    (d.description_eng != "" && d.description_eng != null) ? d.description_eng : d.desription_ind)

                $('#list').append(temp)
            })
        }
    }

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.basic.forEach(function(d) {
                $("#comm").html((lang == "id" && d.comm_id != '' && d.comm_id != null) ? d.comm_id : (d.comm != "" && d.comm !=
                    null) ? d.comm : d.comm_id)
            })
            $('#bg, #container').show()
            $('#loader').hide()
        }
    }

    checkData()

    function Reset() {
        $("#txtName").val("")
        $("#txtEmail").val("")
        $("#txtSketch").val("")
        $("#txtWWW").val("")
        $("#txtValidation").val("")
        $("#txtMessage").val("")
        $(':checkbox:checked').each(function(i) {
            $(this).attr('checked', false)
        })
    }

    $('#btnReset').click(function(e) {
        Reset()
    })

    $('#btnSubmit').click(function(e) {
        e.preventDefault()

        if ($("#txtName").val() == "") showAlert("Error", lang == "id" ? "Nama masih kosong, harap diisi." : "Name is empty.")
        else if ($("#txtEmail").val() == "") showAlert("Error", lang == "id" ? "Email masih kosong, harap diisi." : "Email is empty.")
        else if (!isEmail($("#txtEmail").val())) showAlert("Error", lang == "id" ? "Format email salah." : "Wrong email format.")
        else if ($(':checkbox:checked').length == 0) showAlert("Error", lang == "id" ? "Tipe komisi belum dipilih." : "Commission type haven't been chosen.")
        else if ($("#txtValidation").val() == "") showAlert("Error", lang == "id" ? "Teks validasi masih kosong, harap diisi." : "Validation text is empty.")
        else {
            let val = []
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val()
            })
            let data = {
                name: $("#txtName").val(),
                email: $("#txtEmail").val(),
                sketch: $("#txtSketch").val(),
                site: $("#txtWWW").val(),
                message: $("#txtMessage").val(),
                validate: $("#txtValidation").val(),
                type: val
            }

            $.ajax({
                url: base_url + "commission/submit",
                data: data,
                type: "POST",
                dataType: "JSON",
                success: function(ret) {
                    showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                }
            })

            console.log(data)
        }
    })

})