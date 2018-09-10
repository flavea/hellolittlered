gapi.analytics.ready(function() {
    gapi.analytics.auth.authorize({
        container: 'embed-api-auth-container',
        clientid: '109380645046-g42iprog6s7203duj8sjth5es48e4r40.apps.googleusercontent.com'
    })

    var viewSelector = new gapi.analytics.ViewSelector({
        container: 'view-selector-container'
    })

    viewSelector.execute()

    var dataChart = new gapi.analytics.googleCharts.DataChart({
        query: {
            metrics: 'ga:sessions',
            dimensions: 'ga:date',
            'start-date': '30daysAgo',
            'end-date': 'yesterday'
        },
        chart: {
            container: 'chart-container',
            type: 'LINE',
            options: {
                width: '100%'
            }
        }
    })
    viewSelector.on('change', function(ids) {
        dataChart.set({
            query: {
                ids: ids
            }
        }).execute()
    })

})

$(document).ready(() => {
    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.basic.forEach(d => {
                $("#txttitle").val(d.title)
                $("#txtkeywords").text(d.keywords.trim())
                $("#txtdescription").text(d.description)
                $("#txtdescription_id").text(d.description_id)
                $("#txttou").text(d.tou)
                $("#txttou_id").text(d.tou_id)
                $("#txtcomm").text(d.comm)
                $("#txtcomm_id").text(d.comm_id)
                $("#txtaff").text(d.aff)
                $("#txtaff_id").text(d.aff_id)
            })

            CKEDITOR.replace('tou')
            CKEDITOR.replace('tou_id')
            CKEDITOR.replace('comm')
            CKEDITOR.replace('comm_id')
            CKEDITOR.replace('aff')
            CKEDITOR.replace('aff_id')
            $('#bg, #container, #table').show()
            $('#load, #loader').hide()
        }
    }

    checkData()

    $("#btnSubmit").click(() => {
        $(this).hide()
        $("#load").show()
        let data = {
            title: $("#txttitle").val(),
            keywords: $("#txtkeywords").val(),
            description: $("#txtdescription").val(),
            description_id: $("#txtdescription_id").val(),
            tou: CKEDITOR.instances.txttou.getData(),
            tou_id: CKEDITOR.instances.txttou_id.getData(),
            comm: CKEDITOR.instances.txtcomm.getData(),
            comm_id: CKEDITOR.instances.txtcomm_id.getData(),
            aff: CKEDITOR.instances.txtaff.getData(),
            aff_id: CKEDITOR.instances.txtaff_id.getData()
        }

        $.ajax({
            url: `${base_url}admin/update_data/`,
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