/**
 * Created by okamiji on 16/6/10.
 */

document.write('<script src="jquery.min.js"> <\/script>')

$(document).ready(function () {

    /* switch tabs */
    $(function () {
        $('#myTab li:eq(1) a').tab('show');
    });

    /* ajax post receipt item */
    //$("#receipt_add").click(function(){
    //    var commodity_name = document.getElementById('commodity_name').value;
    //    var commodity_count = document.getElementById('commodity_count').value;
    //    $.post("receipt/pending",
    //        {
    //            name: commodity_name,
    //            count: commodity_count
    //        },
    //        function(data){
    //            alert(data);
    //        });
    //});

});

function loadXMLDoc() {
    var xmlhttp;
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert("test");
        }
    }
    xmlhttp.open("POST", "receipt/pending", true);
    xmlhttp.send();
}