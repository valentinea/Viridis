<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>


		      <div id="map" class="" style="height:525px; width:100%;"></div>
	    </div>


	    
  </div>



<!------------------------------------------------------------------------------------------------------>

<script id="source" language="javascript" type="text/javascript">

    var RESPONSE = '';

      $(function () 
      {
          console.log("pocetak ajaxa");
    
        $.ajax({      
              url: 'karteJSON.php', 
           	  method:'GET',
              dataType: 'json',                      
              success: function(data)          
              {
              	RESPONSE = data;
                console.log(data);
              	console.log("ajax prosao");
                initMap();
              	console.log("inicijalizacija mape prosla");
              },
              error: function(jqXHR, textStatus, errorThrown)
              {
                  console.log("Error:" + errorThrown);
              }
        });
        console.log("zavrsetak ajaxa");
      }); 
      

//------------------------------------------------------------------------------------------------------------>

      var map;
      var infoWindow;
      var trenutniParkId;
      var trenutniParkNaziv;
      var trenutniParkOpis;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 45.799071, lng: 15.980941},
          mapTypeId: google.maps.MapTypeId.TERRAIN
        });
        
        var parkovi = RESPONSE['parkovi'];
        console.log("ispis parkova");
        console.log(parkovi);
        
        parkovi.forEach(function(park){
          
          trenutniParkId = park.id;
          trenutniParkNaziv = park.naziv;
          trenutniParkOpis = park.opis;
          
          console.log(trenutniParkId);
          console.log(trenutniParkNaziv);
          console.log(trenutniParkOpis);
          
        	var koordinateParka = park['koordinate'];
        	var poligon = new google.maps.Polygon({
	        	paths: koordinateParka,
	        	strokeColor: '#FF0000',
	        	strokeOpacity: 0.8,
	        	strokeWeight: 3,
	        	fillColor: '#FF0000',
	        	fillOpacity: 0.35
        	});
        	
        	poligon.setMap(map);
        	
        	var podaci = {naziv: park.naziv, id: park.id, opis: park.opis};
        	
        	poligon.addListener('click', function(event){
        	showArrays(event, this, podaci);
        	})
        	
        	infoWindow = new google.maps.InfoWindow;
       		
        });
        
      }

      /** @this {google.maps.Polygon} */
      function showArrays(event, context, podaci) {
        console.log('podaci');
        console.log(podaci);
        console.log('this');
        console.log(context);
        console.log('event');
        console.log(event);
        var vertices = context.getPath();
/*
        var contentString = '<b>Bermuda Triangle polygon</b><br>' +
            'Clicked location: <br>' + event.latLng.lat() + ',' + event.latLng.lng() +
            '<br>';
*/
        var nazivInfoWindow = '<a href="povrsina.php?i=' + podaci.id + '">' + "<h4>" + podaci.naziv + "</h4>" + '</a>';
        var opisInfoWindow = "<p>" + podaci.opis + "</p>";
        var urediInfoWindow ;
        var slikaInfoWindow = '<img src="https://ichef-1.bbci.co.uk/news/976/media/images/83351000/jpg/_83351965_explorer273lincolnshirewoldssouthpicturebynicholassilkstone.jpg" height="100" width="100">';

        var contentString = nazivInfoWindow + opisInfoWindow + slikaInfoWindow;
        /*
        // Iterate over the vertices.
        for (var i =0; i < vertices.getLength(); i++) {
          var xy = vertices.getAt(i);
          contentString += '<br>' + 'Coordinate ' + i + ':<br>' + xy.lat() + ',' +
              xy.lng();
        }*/

        // postavljanje contencta u infowindows
        infoWindow.setContent(contentString);
        infoWindow.setPosition(event.latLng);

        infoWindow.open(map);
      }
    </script>



<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmupMY3j8KQ0jBrRODr3TgnuZ5UjJCtfo&libraries=geometry">
</script>


<?php
include_once('../partials/footer.php');
?>
