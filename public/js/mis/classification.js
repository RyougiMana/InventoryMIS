/**
 * Created by okamiji on 16/6/21.
 */
/**
 * Created by okamiji on 16/6/14.
 */

$(document).ready(function () {

    /* unicode解码 */
    var hexToDec = function (str) {
        str = str.replace(/\\/g, "%");
        return unescape(str);
    }

    var commodities = $.ajax({
        url: "/mis/commodity/classification/info/" + $("#id").val(),
        async: false
    }).responseText;

    commodities = commodities.substr(1, commodities.length - 2);
    commodities = commodities.split(",");

    var commodityNames = new Array();
    var commodityCounts = new Array();
    var commodityColors = [
        "#F7464A",
        "#46BFBD",
        "#FDB45C",
        "#949FB1",
        "#4D5360",];
    for (var i = 0; i < commodities.length; i++) {
        if (i % 2 == 0) {
            commodityNames[i / 2] = hexToDec(commodities[i]);
        }
        else {
            commodityCounts[(i - 1) / 2] = commodities[i];
        }
    }

    var randomColorFactor = function () {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function (opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: commodityCounts,
                backgroundColor: commodityColors,
            }],
            labels: commodityNames
        },
        options: {
            responsive: true
        }
    };

    var ctx = document.getElementById("canvas").getContext("2d");
    new Chart(ctx, config);

});

