$(document).ready(() => {
    let url = window.location.href
    let slug = url.split("/").pop()
    if (slug == "category" || slug == "") slug = "all"
    $.getJSON(`${base_url}blog/get_category_posts/${slug}`, loadPosts)

    function loadPosts(data) {
        if (data.category.length > 0) {
            data.category.forEach(d => {
                $('h2').text(d.category_name)
            })
        }
        if (data.query.length > 0) {
            $('#loadThemes').empty()
            data.query.forEach(d => {
                let temp = `<li><a href='${base_url}post/${d.entry_id}'>${d.entry_name}</a></li>`
                $('.lists').append(temp)
            })
        } else $('.lists').html("<center>Data not found</center>")

        $('#theme-loader').hide()

        $('#bg, #container').show()
        $('#loader').hide()
    }
})