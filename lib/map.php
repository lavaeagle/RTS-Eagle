<!-- Map Placeholder -->
<div id="myMap"></div> 

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
<script>
  	/*
	// Create an array of styles.
  	var styles = [
  	{
    	featureType: "administrative.country",
    	elementType: "geometry",
    	stylers: [
      		{ saturation: 37 },
      		{ visibility: "simplified" }
    	]
  	},{
    	featureType: "administrative.province",
    	stylers: [
      		{ visibility: "off" }
    	]
  	}
	];

	// option for google map object
	var myOptions = {
		zoom: defaultZoom,
		center: defaultLatlng,
		mapTypeId: google.maps.MapTypeId.TERRAIN,
		styles: styles
	}
	*/
// Root path to data directory
         
            // data file with markers (could also be a PHP file for dynamic markers)
            var newDate = new Date;				
            var markerFile = 'markers.php';	
         
            // set default map properties
            var defaultLatlng = new google.maps.LatLng(49.00,10.00);
            
            // zoom level of the map		
            var defaultZoom = 2;
            
            // variable for map
            var map;
            
            // variable for marker info window
            var infowindow;
         
            // List with all marker to check if exist
            var markerList = {};
         
            // set error handler for jQuery AJAX requests
            $.ajaxSetup({"error":function(XMLHttpRequest,textStatus, errorThrown) {   
                alert(textStatus + ' / ' + errorThrown + ' / ' + XMLHttpRequest.responseText);
            }});
        
            // option for google map object
            var myOptions = {
                zoom: defaultZoom,
                center: defaultLatlng,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
        
        
            /**
             * Load Map
             */
            function loadMap(){
        
                // create new map make sure a DIV with id myMap exist on page
                map = new google.maps.Map(document.getElementById("myMap"), myOptions);
        
                // create new info window for marker detail pop-up
                infowindow = new google.maps.InfoWindow();
                
                // load markers
                loadMarkers();
            }
         
         
            /**
             * Load markers via ajax request from server
             */
            function loadMarkers(){
         
                // load marker jSon data		
                $.getJSON(markerFile, function(data) {
                    
                    // loop all the markers
                    $.each(data.markers, function(i,item){
        
                        // add marker to map
                        loadMarker(item);	
        
                    });
                });	
            }
        
            /**
             * Load marker to map
             */
            function loadMarker(markerData){
            
                // get date
                var mDate = new Date( markerData['created']*1000 );
            
                // create new marker location
                var myLatlng = new google.maps.LatLng(markerData['lat'],markerData['long']);
        
                // create new marker				
                var marker = new google.maps.Marker({
                    id: markerData['id'],
                    map: map, 
                    title: markerData['creator'] + ' - ' + markerData['name'] ,
                    position: myLatlng
                });
        
                // add marker to list used later to get content and additional marker information
                markerList[marker.id] = marker;
        
                // add event listener when marker is clicked
                // currently the marker data contain a dataurl field this can of course be done different
                google.maps.event.addListener(marker, 'click', function() {
                    
                    // show marker when clicked
                    showMarker(marker.id);
        
                });
        
                // add event when marker window is closed to reset map location
                google.maps.event.addListener(infowindow,'closeclick', function() { 
                    map.setCenter(defaultLatlng);
                    map.setZoom(defaultZoom);
                }); 	
                
                // add marker to list
                var listItem = $("<li/>");
                $("<a/>").attr('href','#').click( function() { 
                        showMarker( marker.id );
                        return false;
                    }).text( markerData['creator'] + ' - ' + markerData['name'] ).appendTo( listItem );
                $("<label/>").text( mDate.toDateString() ).appendTo(listItem);
                $('#myMapList').prepend( listItem );                
            }
        
            /**
             * Show marker info window
             */
            function showMarker(markerId){
                
                // get marker information from marker list
                var marker = markerList[markerId];
                
                // check if marker was found
                if( marker ){
                
                    // get marker detail information from server
                    /*
                    $.get( dataRoot + 'data/' + marker.id + '.html' , function(data) {
                        // show marker window
                        infowindow.setContent(data);
                        infowindow.open(map,marker);
                    });	
					*/
					infowindow.setContent('troops');
                    infowindow.open(map,marker);
                }else{
                    alert('Error marker not found: ' + markerId);
                }
            }	
             
            /**
             * Adds new marker to list
             */
            function newMarker(){
         
                // get new city name
                var markerAddress = $('#newMarker').val();
         
                // create new geocoder for dynamic map lookup
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'address': markerAddress}, function(results, status) {
                
                    // check response status
                    if (status == google.maps.GeocoderStatus.OK) {
                        
                        // Fire Google Goal 
                        _gaq.push(['_trackPageview', '/tracking/marker-submit']);			
        
                        // set new maker id via timestamp
                        var newDate = new Date;				
                        var markerId = newDate.getTime();
                        
                        // get name of creator
                        var markerCreator = prompt("Please enter your name","");
                        
                        // create new marker data object
                        var markerData = {
                            'id': markerId,
                            'lat': results[0].geometry.location.lat(),
                            'long': results[0].geometry.location.lng(),
                            'creator': markerCreator,
                            'name': markerAddress,
                        };
         
                        // save new marker request to server
                        $.ajax({
                            type: 'POST',			
                            url: dataRoot + "data.php",
                            data: {
                                marker: markerData
                            },
                            dataType: 'json',
                            async: false,
                            success: function(result){
                                // add marker to map
                                loadMarker(result);
                                                        
                                // show marker detail
                                showMarker(result['id']);
                            }
                        });
                        
                    }else if( status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT){
                        alert("Marker not found:" + status);
                    }
                });
            }

</script>
