/**
 * Created by okamiji on 16/6/14.
 */

$(document).ready(function () {

    var YEARS = ["2012", "2013", "2014", "2015", "2016"];

    /* 销售部分 */
    var ajaxCommodityY_sale = $.ajax({
        url: "/miscommodity/info/commodity/sale/y/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityY_sale = ajaxCommodityY_sale.substr(1, strlen(ajaxCommodityY_sale) - 2);
    commodityY_sale = commodityY_sale.split(",");

    /* 进货部分 */
    var ajaxCommodityY_purchase = $.ajax({
        url: "/miscommodity/info/commodity/purchase/y/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityY_purchase = ajaxCommodityY_purchase.substr(1, strlen(ajaxCommodityY_purchase) - 2);
    commodityY_purchase = commodityY_purchase.split(",");

    function getMax(str, number) {
        var max = 0;
        for (var i = 0; i < number; i++) {
            if (str[i] > max) {
                max = str[i];
            }
        }
        return max;
    }

    var maxY_sale = getMax(commodityY_sale, 31);
    var maxY_purchase = getMax(commodityY_purchase, 31);
    var maxY = 0;
    if (maxY_sale >= maxY_purchase) {
        maxY = maxY_sale;
    }
    else {
        maxY = maxY_purchase;
    }

//    $("#myDiv").html(commodityD_sale);


    function strlen(str) {
        var len;
        var i;
        len = 0;
        for (i = 0; i < str.length; i++) {
            if (str.charCodeAt(i) > 255) len += 2;
            else len++;
        }
        return len;
    }

    var randomColorFactor = function () {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function (opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };

    var config = {
        type: 'line',
        data: {
            labels: YEARS,
            datasets: [{
                label: "商品销售",
                data: commodityY_sale,
                borderDash: [5, 5],
            }, {
                label: "商品进货",
                data: commodityY_purchase,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: '商品近五年趋势'
            },
            tooltips: {
                mode: 'label',
                callbacks: {}
            },
            hover: {
                mode: 'dataset'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Year'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: maxY,
                    }
                }]
            }
        }
    };

    $.each(config.data.datasets, function (i, dataset) {
        dataset.borderColor = randomColor(0.4);
//        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });

    var ctx_y = document.getElementById("canvasYear").getContext("2d");
    window.myLine = new Chart(ctx_y, config);

    /***************************************************************************************************/


    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    /* 销售部分 */
    var ajaxCommodityM_sale = $.ajax({
        url: "/miscommodity/info/commodity/sale/m/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityM_sale = ajaxCommodityM_sale.substr(1, strlen(ajaxCommodityM_sale) - 2);
    commodityM_sale = commodityM_sale.split(",");

    /* 进货部分 */
    var ajaxCommodityM_purchase = $.ajax({
        url: "/miscommodity/info/commodity/purchase/m/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityM_purchase = ajaxCommodityM_purchase.substr(1, strlen(ajaxCommodityM_purchase) - 2);
    commodityM_purchase = commodityM_purchase.split(",");

    var maxM_sale = getMax(commodityM_sale, 31);
    var maxM_purchase = getMax(commodityM_purchase, 31);
    var maxM = 0;
    if (maxM_sale >= maxM_purchase) {
        maxM = maxM_sale;
    }
    else {
        maxM = maxM_purchase;
    }

    $("#myDiv").html(commodityM_sale);

    var config = {
        type: 'line',
        data: {
            labels: MONTHS,
            datasets: [{
                label: "商品销售",
                data: commodityM_sale,
                borderDash: [5, 5],
            }, {
                label: "商品进货",
                data: commodityM_purchase,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: '商品在本年度不同月份趋势'
            },
            tooltips: {
                mode: 'label',
                callbacks: {}
            },
            hover: {
                mode: 'dataset'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: maxM,
                    }
                }]
            }
        }
    };

    $.each(config.data.datasets, function (i, dataset) {
        dataset.borderColor = randomColor(0.4);
//        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });

    var ctx_m = document.getElementById("canvasMonth").getContext("2d");
    window.myLine = new Chart(ctx_m, config);


    /***************************************************************************************************/


    var DAYS = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10",
        "11", "12", "13", "14", "15", "16", "17", "18", "19", "20",
        "21", "22", "23", "24", "25", "26", "27", "28", "29", "30",
        "31"];

    /* 销售部分 */
    var ajaxCommodityD_sale = $.ajax({
        url: "/miscommodity/info/commodity/sale/d/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityD_sale = ajaxCommodityD_sale.substr(1, strlen(ajaxCommodityD_sale) - 2);
    commodityD_sale = commodityD_sale.split(",");


    /* 进货部分 */
    var ajaxCommodityD_purchase = $.ajax({
        url: "/miscommodity/info/commodity/purchase/d/" + $("#id").val(),
        async: false
    }).responseText;

    var commodityD_purchase = ajaxCommodityD_purchase.substr(1, strlen(ajaxCommodityD_purchase) - 2);
    commodityD_purchase = commodityD_purchase.split(",");

    var maxD_sale = getMax(commodityD_sale, 31);
    var maxD_purchase = getMax(commodityD_purchase, 31);
    var maxD = 0;
    if (maxD_sale >= maxD_purchase) {
        maxD = maxD_sale;
    }
    else {
        maxD = maxD_purchase;
    }

    var config = {
        type: 'line',
        data: {
            labels: DAYS,
            datasets: [{
                label: "商品销售",
                data: commodityD_sale,
                borderDash: [5, 5],
            }, {
                label: "商品进货",
                data: commodityD_purchase,
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: '商品在本月不同日期趋势'
            },
            tooltips: {
                mode: 'label',
                callbacks: {}
            },
            hover: {
                mode: 'dataset'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Day'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        show: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        suggestedMin: 0,
                        suggestedMax: maxD,
                    }
                }]
            }
        }
    };

    $.each(config.data.datasets, function (i, dataset) {
        dataset.borderColor = randomColor(0.4);
        //   dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });

    var ctx_d = document.getElementById("canvasDay").getContext("2d");
    window.myLine = new Chart(ctx_d, config);

});

