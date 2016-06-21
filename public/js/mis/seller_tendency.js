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

    var ajaxTendency = $.ajax({
        url: "/mis/seller/tendency/info/" + $("#id").val(),
        async: false
    }).responseText;

    var tendency = ajaxTendency.substr(1, strlen(ajaxTendency) - 2);
    tendency = tendency.split(",");

    var ajaxAverage = $.ajax({
        url: "/mis/seller/tendency/avg/" + $("#id").val(),
        async: false
    }).responseText;

    var average = ajaxAverage.substr(1, strlen(ajaxAverage) - 2);
    average = average.split(",");

    var config = {
        type: 'line',
        data: {
            labels: MONTHS,
            datasets: [{
                label: "月消费额",
                data: tendency,
                borderDash: [5, 5],
            }, {
                label: "平均月消费额",
                data: average,
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

    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);


});

