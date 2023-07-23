// chart colors
//Google Visualization 
google.load("visualization", "1", {
  packages: ["corechart"]
});

$(document).ready(function () {
  drawRegionsMap();
})

//Geo Charts
google.load('visualization', '1', {'packages': ['geochart']});
google.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable([
    ['Country', 'Popularity'],
    ['Germany', 182],
    ['IN', 763],
    ['United States', 121],
    ['Brazil', 321],
    ['Canada', 325],
    ['France', 120],
    ['RU', 281]
    ]);

  var options = {
    width: 'auto',
    height: '210',
    backgroundColor: 'transparent',
    colors: ["#1e825e","#b5799e","#47759e","#F5B544", "#EC7343"],
  };

  var chart = new google.visualization.GeoChart(document.getElementById('locations'));
  chart.draw(data, options);
};

//Resize charts and graphs on window resize
$(document).ready(function () {
  $(window).resize(function(){
    drawRegionsMap();
  });
});
