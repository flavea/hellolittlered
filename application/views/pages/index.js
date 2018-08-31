$(document).ready(() => {
    function checkData() {
        if (typeof site_data === "undefined") {
            setTimeout(checkData, 50);
        } else {
            site_data.pages.forEach(d => {
                let page_name = (lang == "id" && d.page_title_id != '' && d.page_title_id != null) ? d.page_title_id : (d.page_title != "" && d.page_title != null) ? d.page_title : d.page_title_id;
                let temp = `<li><a href='${base_url}p/${d.slug}'>${page_name}</a></li>`;
                $(".post ul").append(temp)
            });
            $('#bg, #container').show();
            $('#loader').hide();
        }
    }

    checkData();
});