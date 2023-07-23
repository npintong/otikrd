	var $border_color = "#efefef";
	var $grid_color = "#ddd";
	var $default_black = "#666";
	var $green = "#74B749";
	var $yellow = "#FFB400";
	var $orange = "#F08C56";
	var $blue = "#0DAED3";
	var $red = "#F63131";
	var $teal = "#ED6D49";
	var $grey = "#999999";
	var $dark_blue = "#0D4F8B";
$(function () {

	var data, chartOptions;
	
	data = [
		{ label: "BlueMooon App", data: Math.floor (Math.random() * 100 + 190) }, 
		{ label: "Bluemoon WebMail", data: Math.floor (Math.random() * 100 + 220) }, 
		{ label: "Bluemoon Dashboard", data: Math.floor (Math.random() * 100 + 370) }
	];

	chartOptions = {		
		series: {
			pie: {
				show: true,  
				innerRadius: 0, 
				stroke: {
					width: 1
				}
			}
		},
		grid:{
      hoverable: true,
      clickable: false,
      borderWidth: 1,
			tickColor: $border_color,
      borderColor: $grid_color,
    },
		legend: {
			position: 'ne'
		},
		shadowSize: 0,
		tooltip: true,
		
		tooltipOpts: {
			content: '%s: %y'
		},
		colors: [$red, $blue, $yellow, $red, $teal],
	};

  var holder = $('#pie-chart');

  if (holder.length) {
      $.plot(holder, data, chartOptions );
  }
			
});