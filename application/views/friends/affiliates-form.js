$(document).ready(function() {

    function Reset() {
        $("#txtName").val("")
        $("#txtWebsite").val("")
        $("#txtDescription").val("")
    }

    $('#btnReset').click(function(e) {
        Reset()
    })

    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.basic.forEach(function(d) {
                $("#rules").html((lang == "id" && d.aff_id != '' && d.aff_id != null) ? d.aff_id : (d.aff != "" && d.aff !=
                    null) ? d.aff : d.aff_id)
            })
            $('#bg, #container').show()
            $('#loader').hide()
        }
    }

    checkData()

    $('#btnSubmit').click(function(e) {
        e.preventDefault()

        if ($("#txtName").val() == "") showAlert("Error", lang == "id" ? "Nama masih kosong, harap diisi." : "Name is empty.")
        else if ($("#txtWebsite").val() == "") showAlert("Error", lang == "id" ? "Website masih kosong, harap diisi." : "Website is empty.")
        else if ($("#txtDescription").val() == "") showAlert("Error", lang == "id" ? "Deskripsi masih kosong, harap diisi." : "Description is empty.")
        else {
            let val = []
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val()
            })
            let data = {
                name: $("#txtName").val(),
                description: $("#txtDescription").val(),
                website: $("#txtWebsite").val()
            }

            $.ajax({
                url: base_url + "friends/submit",
                data: data,
                type: "POST",
                dataType: "JSON",
                success: function(ret) {
                    showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                    Reset()
                }
            })

        }
    })

})