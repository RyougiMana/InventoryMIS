/**
 * Created by okamiji on 16/6/17.
 */

$(document).ready(function () {

    var idStr = $("#id").val();
    var idSet = idStr.split(",");

    var commodities = new Array();
    var barChartData;
    var profitChartData;
    var colors = new Array();
    var commodityName = new Array();
    var c_saleCount = new Array();
    var c_saleSum = new Array();
    var c_profitSum = new Array();
    var c_profitQuota = new Array();

    /* unicode解码 */
    var hexToDec = function (str) {
        str = str.replace(/\\/g, "%");
        return unescape(str);
    }

    for (var i = 0; i < idSet.length; i++) {
        commodities[i] = $.ajax({
            url: "/mis/commodity/comparison/make/info/" + idSet[i],
            async: false
        }).responseText;
        commodities[i] = commodities[i].substr(1, commodities[i].length - 2);
        commodities[i] = commodities[i].split(",")

        var saleCount = new Array();
        var saleSum = new Array();
        var profitSum = new Array();
        var profitQuota = new Array();
        for (var j = 0; j < 12; j++) {
            saleCount[j] = commodities[i][j];
            saleSum[j] = commodities[i][12 + j];
            profitSum[j] = commodities[i][24 + j];
            profitQuota[j] = commodities[i][36 + j];
        }
        c_saleCount[i] = saleCount;
        c_saleSum[i] = saleSum;
        c_profitSum[i] = profitSum;
        c_profitQuota[i] = profitQuota;

        commodityName[i] = hexToDec(commodities[i][49]);
        colors[i] = 'rgba(' + Math.round(Math.random() * 255) + ',' + Math.round(Math.random() * 255)
            + ',' + Math.round(Math.random() * 255) + ',.7)';

    }

    if (idSet.length == 1) {
        barChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '销售件数 ' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleCount[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitSum[0],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 2) {

        barChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '销售件数 ' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleCount[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleCount[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleSum[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitSum[1],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 3) {
        barChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '销售件数 ' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleCount[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleCount[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleSum[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitSum[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[2],
                backgroundColor: colors[2],
                data: c_saleCount[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[2],
                backgroundColor: colors[2],
                data: c_saleSum[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[2],
                backgroundColor: colors[2],
                data: c_profitSum[2],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 4) {
        barChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '销售件数 ' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleCount[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_saleSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitSum[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleCount[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_saleSum[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitSum[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[2],
                backgroundColor: colors[2],
                data: c_saleCount[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[2],
                backgroundColor: colors[2],
                data: c_saleSum[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[2],
                backgroundColor: colors[2],
                data: c_profitSum[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '销售件数 ' + commodityName[3],
                backgroundColor: colors[3],
                data: c_saleCount[3],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总营业额' + commodityName[3],
                backgroundColor: colors[3],
                data: c_saleSum[3],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: '总利润额' + commodityName[3],
                backgroundColor: colors[3],
                data: c_profitSum[3],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }

    if (idSet.length == 1) {
        profitChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '利润占比' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitQuota[0],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 2) {
        profitChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '利润占比' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitQuota[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitQuota[1],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 3) {
        profitChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '利润占比' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitQuota[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitQuota[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[2],
                backgroundColor: colors[2],
                data: c_profitQuota[2],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }
    else if (idSet.length == 4) {
        profitChartData = {
            labels: ["January", "February", "March", "April", "May", "June",
                "August", "September", "October", "November", "December"],
            datasets: [{
                type: 'line',
                label: '利润占比' + commodityName[0],
                backgroundColor: colors[0],
                data: c_profitQuota[0],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[1],
                backgroundColor: colors[1],
                data: c_profitQuota[1],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[2],
                backgroundColor: colors[2],
                data: c_profitQuota[2],
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'line',
                label: '利润占比' + commodityName[3],
                backgroundColor: colors[3],
                data: c_profitQuota[3],
                borderColor: 'white',
                borderWidth: 2
            },
            ]

        };
    }

    var ctx = document.getElementById("canvas").getContext("2d");
    var profit_ctx = document.getElementById("profitCanvas").getContext("2d");

    new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: '产品硬实力比较'
            }
        }
    });

    new Chart(profit_ctx, {
        type: 'bar',
        data: profitChartData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: '产品利润占比比较'
            }
        }
    });

});
