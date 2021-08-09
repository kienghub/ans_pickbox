// Denmark
$(function(){
	$('#mapDenmark').vectorMap({
		map: 'dk_mill',
		zoomOnScroll: false,
		regionStyle:{
			initial: {
				fill: '#37b24d',
			},
			hover: {
				"fill-opacity": 0.8
			},
			selected: {
				fill: '#aa0000'
			},
		},
		backgroundColor: 'transparent',
	});
});