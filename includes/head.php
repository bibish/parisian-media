<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Parisian Insider</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/superslides.css">
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Caveat+Brush' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpUcIarOx3NwRIpeXjNW86152r83NNWpU&callback=initMap">
    </script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.animate-enhanced.min.js"></script>
    <script src="js/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/radio.js" type="text/javascript"></script>
   
   <?php
   
        if ($_GET['id']== NULL) {
        $loc = $mysql->prepare('SELECT * FROM podcast  ORDER BY created_at DESC LIMIT 1');
        $loc->execute();
        

        $last_dataloc = $loc->fetch(PDO::FETCH_ASSOC);
        }else{

        $loc = $mysql->prepare('SELECT * FROM podcast  WHERE id = :id');
        $loc->execute(array(
          ':id' => $_GET['id']
          ));
        

        $last_dataloc = $loc->fetch(PDO::FETCH_ASSOC);
        }



        
        $defaultx =48.851271;
        $defaulty =2.365718;


        if(!empty($last_dataloc['x']))
          $defaultx = $last_dataloc['x'];
        if(!empty($last_dataloc['y']))
          $defaulty = $last_dataloc['y'];

      


         ?>
        <script type="text/javascript">

    
                                var map;
                    function initMap() {
                      var myLatLng ={lat: <?php echo $defaultx;?>, lng: <?php echo $defaulty;?>
                      };
                       var myLatLngCenter ={lat: <?php echo $defaultx;?>+0.02 , lng: <?php echo $defaulty;?> 
                      };


                      var map = new google.maps.Map(document.getElementById('map'), {
                                              zoom: 13,
                                              center: myLatLngCenter
                                            });


                      var marker = new google.maps.Marker({
                        position: {lat: <?php echo $defaultx;?>  , lng: <?php echo $defaulty;?>
                      },
                        map: map,
                        title: 'lieux interview'
                      });

                      

                    
                      
                    $('#map').addClass('hidden');
                        $('.map-toggle').on('click', function (e) {
                                e.preventDefault();
                                
                                $('#map').toggleClass('hidden');
                                google.maps.event.trigger(map, 'resize'); 
                                /*var elem = $(this).next('#map')
                                $('#map').not(elem).hide('fast');
                                elem.slideToggle('fast', function () {
                                google.maps.event.trigger(this, 'toggle');
                        });*/
                    });
                    }
      
   
        </script>
    <script>
        $(function () {
            $('#slides, .podcast, .insider, .truc, .concept, .contact').superslides({
                hashchange: true
            });
          var accessToken = '19865897.1677ed0.6eab135b9a724bd3aa168426cd053c64';
          $.getJSON('https://api.instagram.com/v1/users/self/media/recent/?access_token='+accessToken+'&callback=?',function (insta) {
            $.each(insta.data,function (photos,src) {
              if ( photos === 6 ) { return false; }
              $('<a href="'+src.link+'" class="post" target="_blank">'+
                '<div class="image" style="background-image:url('+src.images.standard_resolution.url+');"></div>'+'</a>').appendTo('#content');
            });
          });
            $('#slides').superslides({
                hashchange: true
            });

           $('#slides').on('init.slides', function () {

              var h = $('#slides').height();

              $('#slides').css('height', h+'px');

            });

            $(".menu-collapsed").click(function() {
                $(this).toggleClass("menu-expanded");
            });
        });
    </script>
    <script type="text/javascript" src="js/index.js"></script>
</head>