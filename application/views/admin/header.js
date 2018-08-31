function checkData() {
    if (typeof site_data === "undefined") {
        setTimeout(checkData, 50);
    } else {
        site_data.basic.forEach(d => {
            $("#txttitle").val(d.title)
            $("#txtkeywords").text(d.keywords.trim())
            $("#txtdescription").text(d.description);
            $("#txtdescription_id").text(d.description_id)
            $("#txttou").text(d.tou)
            $("#txttou_id").text(d.tou_id);
            $("#txtcomm").text(d.comm)
            $("#txtcomm_id").text(d.comm_id)
            $("#txtaff").text(d.aff);
            $("#txtaff_id").text(d.aff_id);
        });

        $('#bg, #container, #table').show();
        $('#load').hide();
    }
}

checkData();