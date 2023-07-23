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
		
	var d1, chartOptions;

	d1 = [
		[1262304000000, 92], [1264982400000, 320], [1267401600000, 765], [1270080000000, 929], 
		[1272672000000, 1163], [1275350400000, 1205], [1277942400000, 2102], [1280620800000, 2517], 
		[1283299200000, 3100], [1285891200000, 3240], [1288569600000, 4520], [1291161600000, 3820]
	];

	data = [{ 
		label: "Sales Online", 
		data: d1
	}];
 
		chartOptions = {
			xaxis: {
				min: (new Date(2009, 11, 1)).getTime(),
				max: (new Date(2010, 11, 1)).getTime(),
				mode: "time",
				tickSize: [2, "month"],
				monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				tickLength: 1
			},
			yaxis: {

			},
			series: {
				stack: true,
				lines: {
					show: true, 
					fill: true,
					lineWidth: 3,
          fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.6}] }
				},
				points: {
					show: true,
					radius: 5,
					fill: true,
					fillColor: "#ffffff",
					lineWidth: 3
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
				show: true,
				position: 'nw'
			},
			shadowSize: 0,
			tooltip: true,
			tooltipOpts: {
			content: '%s: %y'
			},
			colors: [$blue, $green, $yellow, $teal, $yellow, $green],
		};

		var holder = $('#area-chart3');

		if (holder.length) {
			$.plot(holder, data, chartOptions );
		}


});