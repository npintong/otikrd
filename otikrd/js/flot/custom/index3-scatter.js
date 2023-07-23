	var $border_color = "#efefef";
	var $grid_color = "#ddd";
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
		
	var d1, d2, d3, data, chartOptions;

	d1 = [[0,12],[21,38],[13,29],[82,14],[52,43],[32,59],[92,48],[68,31],[32,24],[30,67],[10,45],[37,5],[18,41],[31,70],[11,90],[41,20],[41,80],[54,20],[24,70],[34,30],[44,80],[34,60],];
	d2 = [[23,40],[46,16],[20,42],[33,41],[51,39],[11,28],[32,36],[38,40]];

	data = [{ 
		label: "Positive", 
		data: d1,
	}, {
		label: "Negative",
		data: d2,
	}];

	chartOptions = {
		xaxis: {
					
		},
		yaxis: {

		},
		series: {
			lines: {
				show: false, 
				fill: false,
				lineWidth: 4,
			},
			points: {
				show: true,
				radius: 3,
				fill: true,
				lineWidth: 6,
			}
		},
		grid:{
      hoverable: true,
      clickable: true,
      borderWidth: 1,
			tickColor: "#eee",
			borderColor: "#eee",
    },
		legend: {
			show: true
		},
			
		tooltip: true,
		tooltipOpts: {
			content: '%s: %y'
		},
		shadowSize: 0,
		colors: [$blue, $red, $yellow, $teal, $yellow, $green],
	};

	var holder = $('#scatter-chart');

	if (holder.length) {
		$.plot(holder, data, chartOptions );
	}


});