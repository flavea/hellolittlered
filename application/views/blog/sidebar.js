$(document).ready(() => {
    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50)
        } else {
            site_data.basic.forEach(function(d) {
                $("#intro > p").html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description != "" && d.description != null) ? d.description : d.description_id)
                $("#intro > h2").html(d.title)
            })
            site_data.categories.forEach(function(d) {
                $("#categories").append("<li><a href='" + base_url + 'category/' + d.slug + "'>" + d.category_name + "</a></li>")
            })
            site_data.websites.forEach(function(d) {
                let temp = $('.webTemp').clone().removeClass('webTemp').show()
                $('a', temp).attr('href', d.link)
                $('a', temp).text(d.name)
                $('.published', temp).html(d.description)
                $(".websites").append(temp)
            })
            site_data.sidebars.forEach(function(d) {
                let temp = $('.blurbTemp').clone().removeClass('blurbTemp').show()
                $(temp).html(d.content)
                $("#sidebars").append(temp)
            })
            $('.music').text(site_data.music)
            $('.book').text(site_data.book)
        }
    }

    checkData()
})