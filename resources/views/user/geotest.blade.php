<!DOCTYPE html>
<html>
  <head>
    <title>Place Searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>

    <div id="map"></div>

        

    
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  
  let users = <?php echo json_encode($users) ?>;
  console.log(users);
  
  function initMap() {
          var myLatLng = {lat: 53.2193133, lng: 6.5669632};
  
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
            center: myLatLng
          });
  
          var markers = [];
          for (let i of users) {
            markers.push(
              new google.maps.Marker({
                position: {lat: parseFloat(i.latitude), lng: parseFloat(i.longitude)},
                map: map,
                title: i
                
                //hier wil ik eigelijk nog de naam van de gebruiker die vertoont wordt als je op de marker klikt. 
            }));
          

          }


          // locatie dichtbij 

          function succes(postion){
            console.log(position);
            var latval = position.coords.latitude;
            var lngval = position.coords.longitude;
            myLatLng = new google.maps.LatLng(latval, lngval);
            createMap(myLatLng);


          }


         // functie voor dichtbijzijnde users mbv lat en lng en die in controller  zetten.
         // evt een controller maken en een 
         //wat opzetjes voor functies en controllers 
         // Route::get('/zoek', 'ZoekController@zoek');
        
        class ZoekController extends Conntroller{

          public function zoekadusers(Request $request){

            $lat=$request ->lat;
            $lng=$request ->lng;


            //bij 500 meter 
            $users=User::whereBetween('lat', [$lat-0.005, $lat+0.005])->whereBetween('lng',[$lng-0.5, $lng+0.5])->get();
            

            //bij 10000meter 

            $users=User::whereBetween('lat, [$lat-0.1, $lat+0.1')


            return $users;

 



          }



          function zoekadverteerders(lat,lng){
            $.post('http://localhost/')
          }



        }






          // var marker = new google.maps.Marker({
          //   position: myLatLng,
          //   map: map,
          //   title: 'Hello World!'
          // });
          // var marker2 = new google.maps.Marker({
          //   position: {lat: 53.2183133, lng: 6.5669632},
          //   map: map,
          //   title: 'Hello World!'
          // });
          
  
          // var myLatlng = new google.maps.LatLng(53.2193133,6.5669632);
          
          // var mapOptions = {
          //   zoom: 4,
          //   center: myLatlng
          // }
          // // var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  
          // // var marker = new google.maps.Marker({
          // //   position: myLatlng,
          // //   title:"Hello World!"
          // });
  }
  
   </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfM9rq072pO3kYg5hTX_69uA-6LeVKhF8&libraries=places&callback=initMap" async defer></script>


</body>
</html>