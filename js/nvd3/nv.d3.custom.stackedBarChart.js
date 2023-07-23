var chart = nv.models.multiBarChart();
chart.margin({"left":40,"right":0,"top":10,"bottom":20});
chart.showControls(false);
d3.select('#bills svg').datum([{
	key: "Due",
	color: "#ed6d49",
	values:
	[      
		{ x : "Mon", y : 21 },
		{ x : "Tue", y : 17 },
		{ x : "Wed", y : 25 },
		{ x : "Thu",   y : 73 },
		{ x : "Fri",   y : 55 },  
		{ x : "Sat",   y : 42 },
		{ x : "Sun", y : 4 },
	]
	},
	{
	key: "Paid",
	color: "#3693cf",
	values:
	[      
		{ x : "Mon", y : 34 },
		{ x : "Tue", y : 23 },
		{ x : "Wed", y : 54 },
		{ x : "Thu",   y : 66 },
		{ x : "Fri",   y : 81 },  
		{ x : "Sat",   y : 72 },
		{ x : "Sun", y : 29 },
	]
	}
]).transition().duration(1000).call(chart);