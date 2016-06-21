/**
 * Created by okamiji on 16/6/22.
 */

$(document).ready(function () {

    function getMax(str, number) {
        var max = 0;
        for (var i = 0; i < number; i++) {
            if (str[i] > max) {
                max = str[i];
            }
        }
        return max;
    }

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

    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var ajaxPurchase = $.ajax({
        url: "/mis/management/purchase/info",
        async: false
    }).responseText;

    var purchase = ajaxPurchase.substr(1, strlen(ajaxPurchase) - 2);
    purchase = purchase.split(",");

    var ajaxSale = $.ajax({
        url: "/mis/management/sale/info",
        async: false
    }).responseText;

    var sale = ajaxSale.substr(1, strlen(ajaxSale) - 2);
    sale = sale.split(",");

    var config = {
        type: 'line',
        data: {
            labels: MONTHS,
            datasets: [{
                label: "月销售额",
                data: sale,
                borderDash: [5, 5],
            }, {
                label: "月进货额",
                data: purchase,
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
                        suggestedMax: 100,
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

    var ctx_d = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx_d, config);

});
