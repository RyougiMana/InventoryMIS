/**
 * Created by okamiji on 15/12/3.
 */
function loadXMLDoc() {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = cfunc;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
function myFunction() {
    loadXMLDoc("/ajax/test1.txt", function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    });
}