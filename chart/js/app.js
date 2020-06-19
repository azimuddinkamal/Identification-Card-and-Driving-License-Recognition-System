$(function () {
    $.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        method: "POST",
        data: {'ajaxcall': 'dailygraph'},
        success: function (data) {
            chartData = data;
            var chartProperties = {
                caption: "Number of visitor in a day",
                xAxisName: "Time",
                yAxisName: "Visitor",
                rotatevalues: "1",
                theme: "zune"
            };
            apiChart = new FusionCharts({
                type: "column2d",
                renderAt: "chart-container-1",
                width: "550",
                height: "350",
                dataFormat: "json",
                dataSource: {
                    chart: chartProperties,
                    data: chartData
                }
            });
            apiChart.render();
        }
    });

    $.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        method: "POST",
        data: {'ajaxcall': 'weeklygraph'},
        success: function (data) {
            chartData = data;
            var chartProperties = {
                caption: "Number of visitor in a week",
                xAxisName: "Time",
                yAxisName: "Visitor",
                rotatevalues: "1",
                theme: "zune"
            };
            apiChart = new FusionCharts({
                type: "column2d",
                renderAt: "chart-container-2",
                width: "550",
                height: "350",
                dataFormat: "json",
                dataSource: {
                    chart: chartProperties,
                    data: chartData
                }
            });
            apiChart.render();
        }
    });

    $.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        method: "POST",
        data: { 'ajaxcall': 'monthlygraph' },
        success: function (data) {
            chartData = data;
            var chartProperties = {
                caption: "Number of visitor in a month",
                xAxisName: "Time",
                yAxisName: "Visitor",
                rotatevalues: "1",
                theme: "zune"
            };
            apiChart = new FusionCharts({
                type: "column2d",
                renderAt: "chart-container-3",
                width: "550",
                height: "350",
                dataFormat: "json",
                dataSource: {
                    chart: chartProperties,
                    data: chartData
                }
            });
            apiChart.render();
        }
    });

    $.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        method: "POST",
        data: { 'ajaxcall': 'yearlygraph' },
        success: function (data) {
            chartData = data;
            var chartProperties = {
                caption: "Number of visitor in a year",
                xAxisName: "Time",
                yAxisName: "Visitor",
                rotatevalues: "1",
                theme: "zune"
            };
            apiChart = new FusionCharts({
                type: "column2d",
                renderAt: "chart-container-4",
                width: "550",
                height: "350",
                dataFormat: "json",
                dataSource: {
                    chart: chartProperties,
                    data: chartData
                }
            });
            apiChart.render();
        }
    });
});