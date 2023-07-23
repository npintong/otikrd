// chart colors

var $border_color = "#efefef";

var $green = "#ed6d49";
var $yellow = "#74b749";
var $orange = "#0daed3";
var $blue = "#ffb400";
var $red = "#f63131";
var $teal = "#34A097";

//Google Visualization 
google.load("visualization", "1", {
  packages: ["corechart"]
});

$(document).ready(function () {
  drawChart1();
})

function drawChart1() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Eat', 2],
    ['Work', 9],
    ['Commute', 2],
    ['Read', 2],
    ['Sleep', 7],
    ['Play', 2],
    ]);

  var options = {
    width: 'auto',
    height: '260',
    backgroundColor: 'transparent',
    colors: [$blue, $red, $teal, $green, $orange, $yellow],
    tooltip: {
      textStyle: {
        color: '#666666',
        fontSize: 11
      },
      showColorCode: true
    },
    legend: {
      position: 'left',
      textStyle: {
        color: 'black',
        fontSize: 12
      }
    },
    chartArea: {
      left: 0,
      top: 10,
      width: "100%",
      height: "100%"
    }
  };

  var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
  chart.draw(data, options);
}

//Resize charts and graphs on window resize
$(document).ready(function () {
  $(window).resize(function(){
    drawChart1();
  });
});
