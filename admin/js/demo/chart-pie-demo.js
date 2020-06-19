// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example

$(function(){
  $.ajax({
    url: "..//..//..//ajax//ajax.php",
        method: "POST",
        data: { 'ajaxcall': 'piechart' },
        success: function (data) {
            console.log(data);

            var department = [];
            var total = [];
            var sum = 0;

            for(var x in data){
              sum = sum + data[x].value;
            }

            for (var i in data) {
                department.push(data[i].label);
                total.push(data[i].value);
            }
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
              type: 'doughnut',
              data: {
                labels: department,
                datasets: [{
                  data: total,
                  backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 	'#FFFF00'],
                  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#8FBC8F'],
                  hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
              },
              options: {
                maintainAspectRatio: false,
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: false,
                  caretPadding: 10,
                },
                legend: {
                  display: false
                },
                cutoutPercentage: 80,
              },
            });

          }

  });

});


