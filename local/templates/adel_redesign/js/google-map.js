var googleMapsDraw = (function() {
	
	
	var map, myLocation, myCoords, radius = 5000;
	var markers = [];
	
	var pointArr = [{
		name: 'marker1',
		region: 1,
		coords: {lat: 52.089437, lng: 23.694781},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker2',
		region: 1,
		coords: {lat: 52.114711, lng: 23.692258},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker3',
		region: 1,
		coords: {lat: 52.099189, lng: 23.715390},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker4',
		region: 1,
		coords: {lat: 52.101218, lng: 23.667560},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker5',
		region: 1,
		coords: {lat: 52.110667, lng: 23.775990},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker6',
		region: 1,
		coords: {lat: 52.075588, lng: 23.738299},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker7',
		region: 5,
		coords: {lat: 53.872183, lng: 27.531429},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	},
	{
		name: 'marker8',
	 	region: 5,
		coords: {lat: 54.284665, lng: 26.857110},
		content: 'Аптека №44<br/>г.Брест, ул. Советская 92A'
	}];
	
		
	return {
		drawMarkers: function( regionValue ){
			
			pointArr.forEach(function(item){
				
				if ( item.region == regionValue ) {
					
					var obj = new google.maps.Marker({
						position: new google.maps.LatLng(item.coords),
						icon: "img/google-marker.svg",
						map: map
					});
					google.maps.event.addListener(obj, 'click', function() {new google.maps.InfoWindow({ content: item.content}).open(map,obj)});
					
					markers.push(obj);
				}
			});
			
		},
		
		getMarkersInRadius: function(){
			
			pointArr.forEach(function(item){			
				
				if ( google.maps.geometry.spherical.computeDistanceBetween( new google.maps.LatLng(myCoords), new google.maps.LatLng(item.coords)) < radius ) {
			
					var obj = new google.maps.Marker({
						position: new google.maps.LatLng(item.coords),
						icon: "img/google-marker.svg",
						map: map
					});
					google.maps.event.addListener(obj, 'click', function() {new google.maps.InfoWindow({ content: item.content}).open(map,obj)});
					
					markers.push(obj);
				
				}
			
			})
		},
		
		initMap: function(){
			
			map = new google.maps.Map( document.getElementById('maps-canvas'), {
				zoom: 7,
				center: {lat: 53.9063535, lng: 27.575573}
			});

		},
		
		getMyLocation: function(callback){
			
			// if (navigator.geolocation) {
			//
			// 	var that = this;
			//
			// 	console.log(navigator.geolocation);
			// 	navigator.geolocation.getCurrentPosition( function(position) {
			//
			// 		myCoords = {
			// 			lat: position.coords.latitude,
			// 			lng: position.coords.longitude
			// 		};
            //
			// 		window.globalCoords=myCoords;
			//
			// 		myLocation = new google.maps.Marker({
			// 			position: new google.maps.LatLng(myCoords.lat-0.0019, myCoords.lng),
			// 			icon: "img/geo-location.svg",
			// 			map: map
			// 		});
			//
			// 		markers.push(myLocation);
            //
			// 		map.setCenter(myCoords);
			// 		map.setZoom(14);
			//
			// 		/*
			// 		new google.maps.Circle({
			// 			strokeColor: '#FF0000',
			// 			strokeOpacity: 0.35,
			// 			fillColor: '#FF0000',
			// 			fillOpacity: 0.35,
			// 			map: map,
			// 			center: myCoords,
			// 			radius: radius
			// 		});
			// 		*/
			// 		if ( callback ) callback();
			//
			// 	});
			// } else {
			//
			// }
				
		},
		
		clearAllMarkers: function(){
			markers.forEach(function(item){
				item.setMap(null);
			});
			markers = [];
		},
		
		setMap: function(value){
			map.setZoom(8); 
			map.setCenter(value);

		},
		
	}
	
})();
				
		
			
			
			