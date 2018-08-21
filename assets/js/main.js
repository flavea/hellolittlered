const lang = localStorage.getItem("lang")
const theme = localStorage.getItem("theme")

const base_url = "http://localhost/helloli/"
let site_data

$.getJSON(base_url + "site/get_data", loadData)

function loadData(data) {
    site_data = data

    site_data.basic.forEach(function(d) {
        $("#description p").html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description != "" && d.description != null) ? d.description : d.description_id)
    })

    site_data.sns.forEach(function(d) {
        if (d.behance != "") $('.fa-behance').attr("href", d.behance)
        else $('.fa-behance').remove()
        if (d.codepen != "") $('.fa-codepen').attr("href", d.codepen)
        else $('.fa-codepen').remove()
        if (d.deviantart != "") $('.fa-deviantart').attr("href", d.deviantart)
        else $('.fa-deviantart').remove()
        if (d.facebook != "") $('.fa-facebook').attr("href", d.facebook)
        else $('.fa-facebook').remove()
        if (d.flickr != "") $('.fa-flickr').attr("href", d.flickr)
        else $('.fa-flickr').remove()
        if (d.github != "") $('.fa-github').attr("href", d.github)
        else $('.fa-github').remove()
        if (d.linkedin != "") $('.fa-linkedin').attr("href", d.linkedin)
        else $('.fa-linkedin').remove()
        if (d.soundcloud != "") $('.fa-soundcloud').attr("href", d.soundcloud)
        else $('.fa-soundcloud').remove()
        if (d.tumblr != "") $('.fa-tumblr').attr("href", d.tumblr)
        else $('.fa-tumblr').remove()
        if (d.twitter != "") $('.fa-twitter').attr("href", d.twitter)
        else $('.fa-twitter').remove()
        if (d.youtube != "") $('.fa-youtube').attr("href", d.youtube)
        else $('.fa-youtube').remove()
    })

    site_data.friends.forEach(function(d) {
        let temp = "<a href='" + d.website + "'>" + d.name + '</a>'
        $("#friends").append(temp)
    })

    let abj = 97

    site_data.pages.forEach(function(d) {
        let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id
        let temp = '<a href = "' + base_url + 'p/' + d.slug + '" target = "_blank" >' + page_name + '</a>'
        let menu = '<a href = "' + base_url + 'p/' + d.slug + '" target = "_blank" ><span>' + String.fromCharCode(abj) + ". </span>" + page_name + '</a>'
        $(".pages").append(temp)
        $(".menu-pages").append(menu)
        abj++
    })

    abj = 99

    site_data.theme_categories.forEach(function(d) {
        let menu = '<a href = "' + base_url + 'themes/' + d.slug + '" target = "_blank" ><span>' + String.fromCharCode(abj) + ". </span>" + d.category_name + '</a>'
        $(".menu-codes").append(menu)
        abj++
    })

    $("#friends").append('<a href="' + base_url + 'friends">All Affiliates</a>')
    $("#friends").append('<a href="' + base_url + 'friends/apply">Apply</a>')
}

function showAlert(title, message) {
    $("#alert h2").text(title)
    $("#alert p").html(message)
    $("#alert").show()
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
    return regex.test(email)
}

$(document).scroll(function(event) {
    var y = $(this).scrollTop()
    if (y > 100) {
        $('#mobile-menu').fadeIn()
    } else {
        $('#mobile-menu').fadeOut()
    }
})

$(document).ready(function() {
    $('#bg, #container').hide()
    $('#loader').show()

    if (typeof(Storage) !== "undefined") {
        if (lang === null) {
            localStorage.setItem("lang", "en")
        } else {
            if (lang == "en") {
                $('#fs2').attr('checked', false)
            } else if (lang == "id") {
                $('#fs2').attr('checked', true)
            }
            console.log("Language set to: " + localStorage.getItem("lang"))
        }
        if (theme === null) {
            localStorage.setItem("theme", "light")
        } else {
            if (theme == "light") {
                $('#fs').attr('checked', false)
                $('body').removeClass('dark')
            } else if (theme == "dark") {
                $('#fs').attr('checked', true)
                $('body').addClass('dark')
            }
            console.log("Theme set to: " + localStorage.getItem("theme"))

        }
    } else {
        console.log("no local storage support.")
        $('#theme-changer').hide()
        $('#lang-changer').hide()
    }

    var newloc

    $('pre').addClass('prettyprint')

    $('html').on('click', 'a[data-target]', function(event) {
        var data_id = $(this).attr('data-target')
        $("#" + data_id).toggle()
    })

    $('html').on('click', 'a[href]', function(event) {
        event.preventDefault()
        newloc = $(this).attr("href")
        $('body').fadeOut(1000, newpage)
    })

    function newpage() {

        window.location = newloc

    }

    $('#fs').change(function() {
        if (this.checked) {
            localStorage.setItem("theme", "dark")
            $('body').addClass('dark')
        } else {
            localStorage.setItem("theme", "light")
            $('body').removeClass('dark')
        }
        console.log("Theme switched to: " + localStorage.getItem("theme"))
    })

    $('#fs2').change(function() {
        $('#lang').toggle()
        $('#lang-yes').click(function() {

            if ($('#fs2').is(':checked')) {
                localStorage.setItem("lang", "id")
            } else {
                localStorage.setItem("lang", "en")
            }
            console.log("Theme switched to: " + localStorage.getItem("lang"))
            window.location.reload();
        })
        $('#lang-no').click(function() {
            $('#lang').toggle()
            var lang = localStorage.getItem("lang")
            if (lang == "en") {
                $('#fs2').attr('checked', false)
            } else if (lang == "id") {
                $('#fs2').attr('checked', true)
            }
        })
    })

    $("#btnSearch").click(function(e) {
        e.preventDefault()
        $("#search-loader").show()
        $('#searchres').show()
        $('#search-result').empty()
        $.getJSON(base_url + "site/search/" + $("#searchVal").val(), function(data) {
            if (lang == "en") {
                $('#searchres h2').text("Search Result")
            } else if (lang == "id") {
                $('#searchres h2').text("Hasil Pencarian")
            }

            if (data.blogs_res.length == 0 && data.themes_res.length == 0 && data.page_res.length == 0 && data.projects_res.length == 0) {
                if (lang == "en")
                    $('#search-result').text("Search result is not found.")
                else if (lang == "id")
                    $('#search-result').text("Hasil Pencarian tak ditemukan.")
            }

            if (data.blogs_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk blog:" : "Search result for blog posts:")
                data.blogs_res.forEach(function(d) {
                    let entry = (lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id
                    $('ul', temp).append('<li><a href="' + base_url + 'post/' + d.entry_id + '">' + entry + "</a></li>")
                })
                $('#search-result').append(temp)
            }

            if (data.themes_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk tema:" : "Search result for themes:")
                data.themes_res.forEach(function(d) {
                    $('ul', temp).append('<li><a href="' + base_url + 'theme/' + d.theme_id + '">' + d.theme_name + "</a></li>")
                })
                $('#search-result').append(temp)
            }

            if (data.page_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk halaman:" : "Search result for pages:")
                data.page_res.forEach(function(d) {
                    let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id
                    $('ul', temp).append('<li><a href="' + base_url + 'p/' + d.page_slug + '">' + page_name + "</a></li>")
                })
                $('#search-result').append(temp)
            }

            if (data.projects_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk halaman:" : "Search result for pages:")
                data.projects_res.forEach(function(d) {
                    $('ul', temp).append('<li><a href="' + base_url + 'projects">' + d.name + "</a></li>")
                })
                $('#search-result').append(temp)
            }

            $("#search-loader").hide()
        })
    })

    $("#btt").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow")
        return false
    })
})