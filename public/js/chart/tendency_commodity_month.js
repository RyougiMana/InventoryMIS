/**
 * Created by okamiji on 16/6/14.
 */

function commodityLineChartMonth() {

    var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var ajaxCommodityM = $.ajax({url: "/miscommodity/info/commodity/m/" + $("#id").val(), async: false}).responseText;

    var commodityM = ajaxCommodityM.substr(1, strlen(ajaxCommodityM) - 2);
    commodityM = commodityM.split(",");

    var maxM = getMax(commodityM, 12);

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

    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100);
        //return 0;
    };
    var randomColorFactor = function () {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function (opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };

    var config = {
        type: 'line',
        data: {
            labels: MONTHS,
            datasets: [{
                label: "商品",
                data: commodityM,
                fill: false,
                borderDash: [5, 5],
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
                callbacks: {
                    // beforeTitle: function() {
                    //     return '...beforeTitle';
                    // },
                    // afterTitle: function() {
                    //     return '...afterTitle';
                    // },
                    // beforeBody: function() {
                    //     return '...beforeBody';
                    // },
                    // afterBody: function() {
                    //     return '...afterBody';
                    // },
                    // beforeFooter: function() {
                    //     return '...beforeFooter';
                    // },
                    // footer: function() {
                    //     return 'Footer';
                    // },
                    // afterFooter: function() {
                    //     return '...afterFooter';
                    // },
                }
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
        dataset.backgroundColor = randomColor(0.5);
        dataset.pointBorderColor = randomColor(0.7);
        dataset.pointBackgroundColor = randomColor(0.5);
        dataset.pointBorderWidth = 1;
    });

    window.onload = function () {
        var ctx = document.getElementById("canvasMonth").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

    $('#randomizeData').click(function () {
        $.each(config.data.datasets, function (i, dataset) {
            dataset.data = dataset.data.map(function () {
                return randomScalingFactor();
            });

        });

        window.myLine.update();
    });

    $('#changeDataObject').click(function () {
        config.data = {
            labels: ["July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "My First dataset",
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
                fill: false,
            }, {
                label: "My Second dataset",
                fill: false,
                data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            }]
        };

        $.each(config.data.datasets, function (i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });

        // Update the chart
        window.myLine.update();
    });

    $('#addDataset').click(function () {
        var newDataset = {
            label: 'Dataset ' + config.data.datasets.length,
            borderColor: randomColor(0.4),
            backgroundColor: randomColor(0.5),
            pointBorderColor: randomColor(0.7),
            pointBackgroundColor: randomColor(0.5),
            pointBorderWidth: 1,
            data: [],
        };

        for (var index = 0; index < config.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        config.data.datasets.push(newDataset);
        window.myLine.update();
    });

    $('#addData').click(function () {
        if (config.data.datasets.length > 0) {
            var month = MONTHS[config.data.labels.length % MONTHS.length];
            config.data.labels.push(month);

            $.each(config.data.datasets, function (i, dataset) {
                dataset.data.push(randomScalingFactor());
            });

            window.myLine.update();
        }
    });

    $('#removeDataset').click(function () {
        config.data.datasets.splice(0, 1);
        window.myLine.update();
    });

    $('#removeData').click(function () {
        config.data.labels.splice(-1, 1); // remove the label first

        config.data.datasets.forEach(function (dataset, datasetIndex) {
            dataset.data.pop();
        });

        window.myLine.update();
    });
}