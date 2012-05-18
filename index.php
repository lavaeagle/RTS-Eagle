<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link href='css/styles.css' media="screen" rel="stylesheet" type="text/css" />
</head>

<body onload='initialize();'>

<div class='wrapper'>
	<div id='map'></div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
<script type="text/javascript">
  var map;
  var center = new google.maps.LatLng(29.245489,-29.481919);

  function initialize() {
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
	  },{
	  }
	];

    var myOptions = {
      zoom: 3,
      center: center,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      styles: styles
    };
    map = new google.maps.Map(document.getElementById('map'),
        myOptions);
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

<script src='js/scripts.js'></script>
</body>

</html>