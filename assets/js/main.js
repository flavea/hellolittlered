const lang = localStorage.getItem("lang")
const theme = localStorage.getItem("theme")
let base_url = ""

if (window.location.hostname == "localhost")
    base_url = `${window.location.protocol}//${window.location.hostname}/helloli/`
else
    base_url = `${window.location.protocol}//${window.location.hostname}/`
let newloc

$.getJSON(`${base_url}site/get_data`, loadData)

function loadData(data) {
    site_data = data

    let i = 1
    site_data.menu.forEach(d => {
        let temp = $('.menuTemp').clone().removeClass('menuTemp').show()
        let temp2 = $('.mmTemp').clone().removeClass('mmTemp').show()
        let menu_name = (lang == "id" && d.menu_id != '' && d.menu_id != null) ? d.menu_id : (d.menu_en != "" && d.menu_en != null) ? d.menu_en : d.menu_id
        $('span', temp).text(i < 10 ? `0${i.toString()}` : i)
        $('b', temp).text(menu_name)
        $('span', temp2).text(i < 10 ? `0${i.toString()}` : i)
        $('b', temp2).text(menu_name)
        $('div', temp2).attr('id', `${d.menu_en.replace(" ", "_")}_pop`)

        if (d.parent === "0" && d.link === "") {
            $('a', temp).attr('data-target', d.menu_en.replace(" ", "_"))
            $('div', temp).attr('id', d.menu_en.replace(" ", "_"))

            $.getJSON(`${base_url}menu/get_children/${d.id}`, data2 => {
                let ab = 97
                if (data2.length > 0) {
                    data2.forEach(d2 => {
                        let menu = (lang == "id" && d2.menu_id != '' && d2.menu_id != null) ? d2.menu_id : (d.menu_en != "" && d2.menu_en != null) ? d2.menu_en : d2.menu_id
                        let a = `<a href="${base_url}${d2.link}"><span>${String.fromCharCode(ab)}. </span>${menu}</a>`
                        $(`#${d.menu_en.replace(" ", "_")}, #${d.menu_en.replace(" ", "_")}_pop`).append(a)
                        ab++
                    })
                }

                if (d.menu_en == "About") {
                    site_data.pages.forEach(d => {
                        let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id
                        let temp = `<a href = "${base_url}p/${d.slug}"><span>${String.fromCharCode(ab)}. </span>${page_name}</a>`
                        $("#About, #About_pop").append(temp)
                        ab++
                    })
                }

                if (d.menu_en == "Blog") {
                    site_data.categories.forEach(d => {
                        let temp = `<a href='${base_url}category/${d.slug}'><span>${String.fromCharCode(ab)}. </span>${d.category_name}</a>`
                        $("#Blog, #Blog_pop").append(temp)
                        ab++
                    })
                }

                if (d.menu_en == "Codes") {
                    site_data.theme_categories.forEach(d => {
                        let temp = `<a href = "${base_url}themes/${d.slug}" target = "_blank" ><span>${String.fromCharCode(ab)}. </span>${d.category_name}</a>`
                        $("#Codes, #Codes_pop").append(temp)
                        ab++
                    })
                }

                if (d.menu_en == "Resources") {
                    site_data.resources.forEach(d => {
                        let temp = `<a href = "${base_url}resource/type/${d.type_slug}" target = "_blank" ><span>${String.fromCharCode(ab)}. </span>${d.type_name}</a>`
                        $("#Resources, #Resources_pop").append(temp)
                        ab++
                    })
                }
            })


            $("#leftmenu").append(temp2)
        } else {
            $('a', temp).attr('href', `${base_url}${d.link}`)
            $('a', temp2).attr('href', `${base_url}${d.link}`)
            $("#leftmenu").append($('a', temp2))
        }
        $("#main-menu").append(temp)
        i++
    })

    site_data.basic.forEach(d => {
        $("#description p").html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description != "" && d.description != null) ? d.description : d.description_id)
        $("#intro > p").html((lang == "id" && d.description_id != '' && d.description_id != null) ? d.description_id : (d.description != "" && d.description != null) ? d.description : d.description_id)
        $("#intro > h2").html(d.title)
    })
    site_data.categories.forEach(d => {
        $("#categories").append(`<li><a href='${base_url}category/${d.slug}'>${d.category_name}</a></li>`)
    })
    site_data.websites.forEach(d => {
        let temp = $('.webTemp').clone().removeClass('webTemp').show()
        $('a', temp).attr('href', d.link)
        $('a', temp).text(d.name)
        $('.published', temp).html(d.description)
        $(".websites").append(temp)
    })

    site_data.sidebars.forEach(d => {
        let temp = $('.blurbTemp').clone().removeClass('blurbTemp').show()
        $(temp).html(d.content)
        $("#sidebars").append(temp)
    })

    site_data.sns.forEach(d => {
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

    site_data.friends.forEach(d => {
        let temp = `<a href='${d.website}'>${d.name}</a>`
        $("#friends").append(temp)
    })

    site_data.pages.forEach(d => {
        let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id
        let temp = `<a href = "${base_url}p/${d.slug}" target = "_blank" >${page_name}</a>`
        $(".pages").append(temp)
    })

    $("#friends").append(`<a href="${base_url}friends">All Affiliates</a>`)
    $("#friends").append(`<a href="${base_url}friends/apply">Apply</a>`)
}

function showAlert(title, message) {
    if (title == "error" || title == "Error" || title == "Failed" || title == "failed" || title == "Fail") $("#alert").css("background-color", "rgba(160, 0, 0, .5)")
    else $("#alert").css("background-color", "rgba(0, 128, 0, .5)")
    $("#alert h2").text(title)
    $("#alert p").html(message)
    $("#alert").show()
}

function isEmail(email) {
    const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/
    return regex.test(email)
}

$(document).scroll(function(event) {
    const y = $(this).scrollTop()
    if (y > 100) {
        $('#mobile-menu').fadeIn()
    } else {
        $('#mobile-menu').fadeOut()
    }
})

$(document).ready(() => {
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
            console.log(`Language set to: ${localStorage.getItem("lang")}`)
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
            console.log(`Theme set to: ${localStorage.getItem("theme")}`)

        }
    } else {
        console.log("no local storage support.")
        $('#theme-changer').hide()
        $('#lang-changer').hide()
    }

    $('pre').addClass('prettyprint')

    $('html').on('click', 'a[data-target]', function(event) {
        const data_id = $(this).attr('data-target')
        $(`#${data_id}`).toggle()
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
        console.log(`Theme switched to: ${localStorage.getItem("theme")}`)
    })

    $('#fs2').change(() => {
        $('#lang').toggle()
        $('#lang-yes').click(() => {

            if ($('#fs2').is(':checked')) {
                localStorage.setItem("lang", "id")
            } else {
                localStorage.setItem("lang", "en")
            }
            console.log(`Theme switched to: ${localStorage.getItem("lang")}`)
            window.location.reload()
        })
        $('#lang-no').click(() => {
            $('#lang').toggle()
            const lang = localStorage.getItem("lang")
            if (lang == "en") {
                $('#fs2').attr('checked', false)
            } else if (lang == "id") {
                $('#fs2').attr('checked', true)
            }
        })
    })

    $("#btnSearch").click(e => {
        e.preventDefault()
        $("#search-loader").show()
        $('#searchres').show()
        $('#search-result').empty()
        $.getJSON(`${base_url}site/search/${$("#searchVal").val()}`, data => {
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
                data.blogs_res.forEach(d => {
                    let entry = (lang == "id" && d.entry_name_id != '' && d.entry_name_id != null) ? d.entry_name_id : (d.entry_name != "" && d.entry_name != null) ? d.entry_name : d.entry_name_id
                    $('ul', temp).append(`<li><a href="${base_url}post/${d.entry_id}">${entry}</a></li>`)
                })
                $('#search-result').append(temp)
            }

            if (data.themes_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk tema:" : "Search result for themes:")
                data.themes_res.forEach(d => {
                    $('ul', temp).append(`<li><a href="${base_url}theme/${d.theme_id}">${d.theme_name}</a></li>`)
                })
                $('#search-result').append(temp)
            }

            if (data.page_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk halaman:" : "Search result for pages:")
                data.page_res.forEach(d => {
                    let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id
                    $('ul', temp).append(`<li><a href="${base_url}p/${d.page_slug}">${page_name}</a></li>`)
                })
                $('#search-result').append(temp)
            }

            if (data.projects_res.length > 0) {
                let temp = $('.searchTemp').clone().removeClass('searchTemp').show()
                $('b', temp).text(lang == "id" ? "Hasil pencarian untuk halaman:" : "Search result for pages:")
                data.projects_res.forEach(d => {
                    $('ul', temp).append(`<li><a href="${base_url}projects">${d.name}</a></li>`)
                })
                $('#search-result').append(temp)
            }

            $("#search-loader").hide()
        })
    })

    $("#btt").click(() => {
        $("html, body").animate({ scrollTop: 0 }, "slow")
        return false
    })
})