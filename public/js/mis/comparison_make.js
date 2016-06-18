/**
 * Created by okamiji on 16/6/17.
 */

$(document).ready(function () {
    alert(idArray);
    var randomScalingFactor = function () {
        return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
    };

    var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            type: 'bar',
            label: 'Dataset 1',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            borderColor: 'white',
            borderWidth: 2
        }, {
            type: 'line',
            label: 'Dataset 2',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
            borderColor: 'white',
            borderWidth: 2
        }, {
            type: 'bar',
            label: 'Dataset 3',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
        },]

    };
    window.onload = function () {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Chart.js Combo Bar Line Chart'
                }
            }
        });
    };
});
