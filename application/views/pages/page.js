$(document).ready(() => {
    let url = window.location.href
    let slug = url.split("/").pop()
    $.getJSON(`${base_url}pages/get_page/${slug}`, loadPage)

    function loadPage(data) {
        if (data.length > 0) {
            data.forEach(d => {
                $('#blog h2 > span').text((lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id)
                $('#page-body').html((lang == "id" && d.page_body_id != '' && d.page_body_id != null) ? d.page_body_id : (d.page_body != "" && d.page_body != null) ? d.page_body : d.page_body_id)
            })
        } else {
            $('#blog').html("<center>Data not found</center>")
        }

        $('#bg, #container').show()
        $('#loader').hide()
    }
})