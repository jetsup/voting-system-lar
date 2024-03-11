function getProvinces(comboID) {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get_provinces/", true);
    ajax.onload = function () {
        var list = JSON.parse(this.responseText);
        var option = "<option value=''>-- PROVINCE --</option>";
        for (var i = 0; i < list.length; i++) {
            option += "<option value='" + list[i]['province_id'] + "'>" + list[i]['province_name'] + "</option>";
        }
        document.getElementById(comboID).innerHTML = option;
    };
    ajax.send();
}

function getCounties(provinceID, comboID) {
    if (provinceID == "") {
        document.getElementById("county").innerHTML = "<option value=''>-- SELECT PROVINCE --</option>";
        document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
        return;
    }
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get_counties/?province_id=" + provinceID, true);
    ajax.onload = function () {
        var list = JSON.parse(this.responseText);
        var option = "";
        option += "<option value=''>-- COUNTY --</option>";
        for (var i = 0; i < list.length; i++) {
            option += "<option value='" + list[i]['county_id'] + "'>" + list[i]['county_name'] + "</option>";
        }
        document.getElementById(comboID).innerHTML = option;
    };
    ajax.send();
}

function getConstituencies(countyID, comboID) {
    if (countyID == "") {
        document.getElementById("constituency").innerHTML = "<option value=''>-- SELECT COUNTY --</option>";
        return;
    }
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get_constituencies/?county_id=" + countyID, true);
    ajax.onload = function () {
        var list = JSON.parse(this.responseText);
        var option = "";
        option += "<option value=''>-- CONSTITUENCY --</option>";
        for (var i = 0; i < list.length; i++) {
            option += "<option value='" + list[i]['constituency_id'] + "'>" + list[i]['constituency_name'] + "</option>";
        }
        document.getElementById(comboID).innerHTML = option;
    };
    ajax.send();
}

function selectElectionType(electionTypeID) {
    console.log("Type ID", electionTypeID);
}