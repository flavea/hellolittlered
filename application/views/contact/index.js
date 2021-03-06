$(document).ready(() => {

    $('#bg, #container').show()
    $('#loader').hide()

    $('#btnReset').click(e => {
        $("#txtName, #txtEmail, #txtSubject, #txtMessage, #txtValidate").val("")
    })

    $('#btnSubmit').click(e => {
        e.preventDefault()

        if ($("#txtName").val() == "") showAlert("Error", lang == "id" ? "Nama masih kosong, harap diisi." : "Name is empty.")
        else if ($("#txtEmail").val() == "") showAlert("Error", lang == "id" ? "Email masih kosong, harap diisi." : "Email is empty.")
        else if (!isEmail($("#txtEmail").val())) showAlert("Error", lang == "id" ? "Format email salah." : "Wrong email format.")
        else if ($("#txtSubject").val() == "") showAlert("Error", lang == "id" ? "Subyek masih kosong, harap diisi." : "Subject is empty.")
        else if ($("#txtMessage").val() == "") showAlert("Error", lang == "id" ? "Pesan masih kosong, harap diisi." : "Message is empty.")
        else if ($("#txtValidate").val() == "") showAlert("Error", lang == "id" ? "Teks validasi masih kosong, harap diisi." : "Validation text is empty.")
        else {
            let val = []
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val()
            })
            let data = {
                name: $("#txtName").val(),
                email: $("#txtEmail").val(),
                subject: $("#txtSubject").val(),
                message: $("#txtMessage").val(),
                validate: $("#txtValidate").val()
            }

            $.ajax({
                url: `${base_url}contact/submit`,
                data,
                type: "POST",
                dataType: "JSON",
                success(ret) {
                    showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                }
            })
        }
    })
})