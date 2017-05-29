
//   <!--   //on cree la requete qui cherche l'insider correspondant a l'id
//     // $loc = $mysql->prepare('SELECT * FROM podcast ORDER BY created_at ');
//     // $loc->execute();

//     // $last_data = $loc->fetch(PDO::FETCH_ASSOC);

//     // $lat = $last_data['x'];
//     // $long = $last_data['y'];
//     //  -->


// var map;
// function initMap() {
//   var myLatLng = {lat: <?php echo $lat; ?>, <?php echo $long; ?>};
//   var map = new google.maps.Map(document.getElementById('map'), {
//     zoom: 14,
//     center: myLatLng
//   });

//   var marker = new google.maps.Marker({
//     position: myLatLng,
//     map: map,
//     title: 'Hello World!'
//   });
  
// $('#map').addClass('hidden');
//     $('.map-toggle').on('click', function (e) {
//             e.preventDefault();
            
//             $('#map').toggleClass('hidden');
//             google.maps.event.trigger(map, 'resize'); 
//             /*var elem = $(this).next('#map')
//             $('#map').not(elem).hide('fast');
//             elem.slideToggle('fast', function () {
//             google.maps.event.trigger(this, 'toggle');
//     });*/
// });
// }