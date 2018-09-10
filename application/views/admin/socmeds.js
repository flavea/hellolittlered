$(document).ready(() => {
    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.sns.forEach(d => {
                $("#codepen").val(d.codepen)
                $("#behance").val(d.behance)
                $("#deviantart").val(d.deviantart)
                $("#facebook").val(d.facebook)
                $("#flickr").val(d.flickr)
                $("#github").val(d.github)
                $("#instagram").val(d.instagram)
                $("#linkedin").val(d.linkedin)
                $("#soundcloud").val(d.soundcloud)
                $("#tumblr").val(d.tumblr)
                $("#twitter").val(d.twitter)
                $("#youtube").val(d.youtube)
            })

            $('#bg, #container, #table').show()
            $('#load, #loader').hide()
        }
    }

    checkData()

    $("#btnSubmit").click(function(e) {
        $(this).hide()
        $("#load").show()
        let data = {
            codepen: $("#codepen").val(),
            behance: $("#behance").val(),
            deviantart: $("#deviantart").val(),
            flickr: $("#flickr").val(),
            github: $("#github").val(),
            instagram: $("#instagram").val(),
            linkedin: $("#linkedin").val(),
            soundcloud: $("#soundcloud").val(),
            tumblr: $("#tumblr").val(),
            twitter: $("#twitter").val(),
            youtube: $("#youtube").val(),
        }

        $.ajax({
            url: `${base_url}admin/submit_sns/`,
            data,
            type: "POST",
            dataType: "JSON",
            success(ret) {
                showAlert(ret.status, lang == "id" ? ret.message_id : ret.message)
                $("#load").hide()
                $("#btnSubmit").show()
            }
        })

    })
})