<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>


    	
<!-------------------------------->
        <?php
        
        $gradovi = array("Zagreb", "Šibenik", "Bjelovar");
        $latlng = array("lat=45.815399&lon=15.966568", "lat=43.735328&lon=15.895276","lat=45.898705&lon=16.841847");
        
        //var_dump($gradovi);
        //var_dump($latlng);
        
        for($i = 0; $i < sizeof($gradovi); $i++){
            //echo($gradovi[$i]);
            //echo($latlng[$i]);
            $url = 'https://forecast.io/embed/#'.$latlng[$i].'&name='.$gradovi[$i].'&color=#00aaff&font=Georgia&units=ca';
            //echo($url);
        ?>
           <iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%" src="<?php echo($url); ?>"></iframe> 
        <?php   
        }
        ?>
        <!-- <iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%" src="https://forecast.io/embed/#lat=45.814273&lon=15.982177&name=Zagreb&color=#00aaff&font=Georgia&units=ca"></iframe> -->
            
<!-------------------------------->
	    </div>
	  </div>
	    





<?php
include_once('../partials/footer.php');
?>