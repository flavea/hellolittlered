$(document).ready(() => {
    let url = window.location.href
    let slug = url.split("/").pop()
    if (slug == "blog" || slug == "") slug = 0

    $.getJSON(`${base_url}contact/get_emails/${slug}`, loadEmails)

    function loadEmails(data) {
        if (data.posts.length > 0) {
            $("#entries").empty()
            $("#e").empty()
            data.posts.forEach(d => {
                let temp = $('.pTemp').clone().removeClass('pTemp').show()
                $('.from', temp).text(`${d.name} (${d.email})`)
                $('.message', temp).html(d.message)
                $('#e').append(temp)
            })


            $('.pagination').html(data.paginglinks)
            $('.pagination a').each(function() {
                let link = $(this).attr("href")
                $(this).removeAttr("href")
                $(this).attr("post-target", link)
            })
            $("pagination li span a").addClass("button big")
        } else
            $('#entries').html("<center>Data not found</center>")

        $('#bg, #container').show()
        $('#loader, #posts-loader').hide()
    }

    $('.pagination').on('click', 'a', function(event) {
        let link = $(this).attr("post-target")
        $("#entries").empty()
        $("#posts-loader").show()
        $.getJSON(link, loadPosts)
        window.history.pushState(null, null, `${base_url}contact/emails/${link.split("/").pop()}`)
    })
    $('html').on('click', '#markAll', function(event) {
        $.getJSON(`${base_url}contact/email_mark/${slug}`, function() {})
    })
})