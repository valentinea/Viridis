<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>



<?php
   
	  	// ako je korisnik kliknuo na da promijeni mjesec
    if (isset($_GET['m']) &&  isset($_GET['g'])) {
        // spremi podatke iz GET-a u varijable

        $_SESSION['mj'] = $_GET['m'];
        $_SESSION['god'] = $_GET['g'];

        // ispisi naslov i kalendar
        echo '<br><br><h2 style="position: absolute; left: 47%;">'. $_SESSION["mj"].'. '.$_SESSION["god"].'.</h2><br><br><br>';
        // konkretan poziv fje koja ispisuje kalendar
        echo draw_kalendar($_SESSION["mj"], $_SESSION["god"]);
        // gumbi za mijenjanje mjeseca
		echo '<div style="position: absolute; left: 47%; top:230px;" > <input type="button" class="btn btn-default btn-sm" onclick="dalje(this,'.$_SESSION["mj"].','.$_SESSION["god"].')" value="Natrag" />'
			 .'<input type="button" class="btn btn-default btn-sm" onclick="dalje(this,'.$_SESSION["mj"].','.$_SESSION["god"].')" value="Naprijed" /> </div>';
    }
    else {
        // ako smo na pocetku, ispisi trenutni mjesec
        $_SESSION['god'] = date("Y");
        $_SESSION['mj'] = date("n");
        echo '<h2 style="position: absolute; left: 47%;">'.$_SESSION["mj"].'. '.$_SESSION["god"].'.</h2><br><br>';
        echo draw_kalendar($_SESSION["mj"],$_SESSION["god"]);
        // gumbi za mijenjanje mjeseca
		echo '<div style="position: absolute; left: 47%; top:230px;" > <input type="button" class="btn btn-default btn-sm" onclick="dalje(this,'.$_SESSION["mj"].','.$_SESSION["god"].')" value="Natrag" />'
			 .'<input type="button" class="btn btn-default btn-sm" onclick="dalje(this,'.$_SESSION["mj"].','.$_SESSION["god"].')" value="Naprijed" /> </div>';
    }
	  	
?>
	  	</div>
	  	
	</div>




	<?php


	// funkcija koja crta kalendar
	function draw_kalendar( $month, $year ){

		// zapocni tablicu
		$kalendar = '<table cellpadding="0" cellspacing="0" class="kalendar" style="width: 50%; margin:auto;">';

		// zaglavlje tablice
		$headings = array('PON','UTO','SRI','ČET','PET','SUB','NED');
		$kalendar.= '<tr class="kalendar-row"><td class="kalendar-day-head">'.implode('</td><td class="kalendar-day-head">',$headings).'</td></tr>';

		// postavi varijable
		$running_day = date('N',mktime( 0,0,0,$month,1,$year) )-1;
		$todays_date = date('j');
		$todays_month = date ('n');
		$days_in_month = date('t', mktime( 0,0,0,$month,1,$year) );
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();

		// prvi redak
		$kalendar.= '<tr class="kalendar-row">';

		// ispisi sve prazne dane tjedna do pocetka mjeseca
		for( $x = 0; $x < $running_day; $x++ ) {
			$kalendar.= '<td class="kalendar-day-np"> </td>';
			$days_in_this_week++;
		}

		// nastavi s danima
		for( $list_day = 1; $list_day <= $days_in_month; $list_day++ ){
			$kalendar.= '<td class="kalendar-day">';
			// oznaci danasnji datum
            if ($list_day == $todays_date && $_SESSION['mj'] == $todays_month)
        	    $kalendar.= '<div class="todays-date" >'.$list_day.'</div>';
            else {
            // ispisi ostale dane
                $kalendar.= '<div class="day-number" >'.$list_day.'</div></td>';
            }
			if( $running_day == 6 ) {
				$kalendar.= '</tr>';

				if( ( $day_counter+1 ) != $days_in_month ) {
					$kalendar.= '<tr class="kalendar-row">';
				}
				$running_day = -1;
				$days_in_this_week = 0;
			}

			$days_in_this_week++;
			$running_day++;
			$day_counter++;
		}

	 	// zavrsi preostale dane tjedna
		if( $days_in_this_week < 8 ) {
			for( $x = 1; $x <= (8 - $days_in_this_week); $x++ ){
				$kalendar.= '<td class="kalendar-day-np"> </td>';
			}
		}
		// zadnji red
		$kalendar.= '</tr>';

		// kraj tablice
		$kalendar.= '</table>';

		// vrati sve sto smo nacrtali
		return $kalendar;
	}


	?>

	<script type="text/javascript">
	 var dan;
	 var mj;
	 var god;

	// funkcija za hendlanje mijenjanja mjeseca
	function dalje(val, m, g) {

    	var xhr1 = new XMLHttpRequest();

    	xhr1.onreadystatechange = function() {
        	if( xhr1.readyState == 4 && xhr1.status == 200 ) {
           document.body.innerHTML = "";
             document.body.innerHTML = xhr1.responseText;
            }
        }
        // usput postavi i globalne varijable tako da znamo koji je mjesec korisnik gledao nakon sto rezervira
    	if (val.value == 'Natrag') {
        	if (( ((m-1)>0) && (g==2016)) || ( (m>8) && (g==2015) )) {
            	xhr1.open( "GET", "kalendar.php?" + "m=" + (m-1) + "&g=" + g, true );
            	mj = m-1; god = g; }
        	else if ((m-1)<1) {
                xhr1.open( "GET", "kalendar.php?" + "m=" + 12 + "&g=" + (g-1), true );
                mj = 12; god = g-1; }
            else {
                xhr1.open( "GET", "kalendar.php?" + "m=" + m + "&g=" + g, true );
                mj = m; god = g; }
        }
    	else if (val.value == 'Naprijed') {
        	if (( (m<12) && (g==2015) ) || ( (m<7) && (g==2016) )) {
            	xhr1.open( "GET", "kalendar.php?" + "m=" + (m+1) + "&g=" + g, true );
            	mj = m+1;  god = g; }
        	else if ((m+1)>12) {
                xhr1.open( "GET", "kalendar.php?" + "m=" + 1 + "&g=" + (g+1), true );
                mj = 1; god = g+1; }
            else {
                 xhr1.open( "GET", "kalendar.php?" + "m=" + m + "&g=" + g, true );
                 mj = m; god = g; }
        }

    	xhr1.send();
	}

	</script>


</body>

</html>
