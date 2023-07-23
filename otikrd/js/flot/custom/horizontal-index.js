var $border_color = "#ccc";
var $grid_color = "#ccc";
var $default_black = "#666";
var $green = "#8ecf67";
var $yellow = "#fac567";
var $orange = "#F08C56";
var $blue = "#1e91cf";
var $red = "#f74e4d";
var $teal = "#28D8CA";
var $grey = "#999999";
var $dark_blue = "#0D4F8B";
  
$(function () {

  var ds=[], data, chartOptions;

  ds.push ([[1700, 1],[3400, 2],[2300, 3]]);
  ds.push ([[1300, 1],[1200, 2],[2900, 3]]);

  data = [ {
    label: 'Online',
    data: ds[1]
  }, {
    label: 'Direct',
    data: ds[0]
  }];

  chartOptions = {
    xaxis: {
        
    },
    grid:{
      hoverable: true,
      clickable: false,
      borderWidth: 1,
      tickColor: "#eee",
      borderColor: "#eee",
    },
    shadowSize: 0,
    bars: {
      horizontal: true,
      show: true,
      barWidth: 3*24*60*60*300,
      barWidth: .3,
      fill: true,
      order: true,
      lineWidth: 0,
      fillColor: { colors: [{ opacity: 1}, { opacity: 0.7}] }
    },
  
  tooltip: true,

  tooltipOpts: {
    content: '%s: %x'
  },
    colors: [$blue, $grid_color, $yellow, $teal, $yellow, $green],
  }

  var holder = $('#horizontal-chart');

  if (holder.length) {
      $.plot(holder, data, chartOptions );
  }

});