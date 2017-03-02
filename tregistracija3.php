<?php
include_once('partials/header_index.php');
?>




	<!-- kontejner za podatke registracije -->
  	<div class="container" style="font-family: 'Asap', sans-serif; color: gray;">

		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="padding-top: 7%">

			<div class="form-group">
				<label class="col-sm-3 control-label">OIB</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="oib">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">MBS TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="mbs">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">MIBPG TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="mibpg">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">ŠIFRA DJELATNOSTI</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="djelatnost">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"> Mjerne jedinice?: dodati više mogućnosti, radio button </label>
				<div class="col-sm-7">
					<!-- sve i svašta -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">BANKA TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="banka">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">BROJ RAČUNA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="racun">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">E-MAIL RAČUNA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="emailracuna">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">VALUTA</label>
				<div class="col-sm-7">
					<p> popraviti u dropdown </p>
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="valuta">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">STOPA POREZA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="porez">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">ŽUPANIJA</label>
				<div class="col-sm-7">
					 <select name="zupanija">
						<option value="0" ></option>
    					<option value="" > Zagrebačka </option>
    					<option value="" > Krapinsko-zagorska </option>
    					<option value="" > Sisačko-moslavačka </option>
    					<option value="" > Karlovačka </option>
    					<option value="" > Varaždinska </option>
    					<option value="" > Koprivničko-križevačka </option>
    					<option value="" > Bjelovarsko-bilogorska </option>
    					<option value="" > Primorsko-goranska </option>
    					<option value="" > Ličko-senjska </option>
    					<option value="" > Virovitičko-podravska </option>
    					<option value="" > Požeško-slavonska </option>
    					<option value="" > Brodsko-posavska </option>
    					<option value="" > Zadarska </option>
    					<option value="" > Osječko-baranjska </option>
    					<option value="" > Šibensko-kninska </option>
    					<option value="Vukovarsko-srijemska" > Vukovarsko-srijemska </option>
    					<option value="Splitsko-dalmatinska" > Splitsko-dalmatinska </option>
    					<option value="Istarska" > Istarska </option>
    					<option value="Dubrovačko-neretvanska" > Dubrovačko-neretvanska </option>
    					<option value="Međimurska" > Međimurska </option>
    					<option value="Grad Zagreb" > Grad Zagreb </option>
  					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-1 col-sm-offset-10">
				<input type="submit" name="submit3" value="" id="registracija_nastavak" class="pull-right" >
				</div>
			</div>

		</form>
	</div>


<?php		

	/* provjera je li user već ulogiran ili admin */
	if( isset( $_SESSION["user"] ) ) header("Location: /VIRIDIS/profil.php");
	if( ! isset( $_SESSION["reg2"]) ) echo "<script> window.location.href = 'index.php'; </script> ";

	/* obrada unešenih podataka */

        function ocisti($data){
            for ($i=0; $i<5; $i++) {
                $data[0] = trim($data[0]);		//makni nepotrebne karaktere kao previse space, tab, newline iz input data
                $data[0] = stripslashes($data[0]);	//makne backslashes \ iz user input data
                $data[0] = htmlspecialchars($data[0]);
                }
               echo "provjereno!";
             return $data;
            }

		if( isset($_POST["submit3"]) ) {

			if( $_POST["oib"]=="" || $_POST["mbs"]=="" || $_POST["mibpg"]=="" || $_POST["djelatnost"]=="" || $_POST["banka"]=="" || $_POST["racun"]=="" || $_POST["emailracuna"]=="" ||
				$_POST["valuta"]=="" || $_POST["porez"]=="" || $_POST["zupanija"]=="0" )
					echo  "<script type='text/javascript'> alert('Niste unijeli sve podatke!'); </script>";	
			else {
				
			$log_data = array ( $_POST["oib"], $_POST["mbs"], $_POST["mibpg"], $_POST["djelatnost"], $_POST["banka"], $_POST["racun"], $_POST["emailracuna"], $_POST["valuta"], $_POST["porez"], $_POST["zupanija"] );
		
			$log_data = ocisti($log_data);

			$_SESSION["array3"]=$log_data;
			
			$uspjeh1 = insert_into_racuni ( $_SESSION["id"], $_POST["banka"], $_POST["racun"], $_POST["emailracuna"] );
			
			
			
/*			uspoređivati postoji li išta istog
 
            if (find_username ($log_data[0]))
                echo "<script type='text/javascript'> alert('Korisničko ime je zauzeto!'); </script>";
            else
                if (find_email ($log_data[3]))
                    echo "<script type='text/javascript'> alert('Email je već u uporabi!'); </script>";
                else
                    if (find_name2show ($log_data[4]))
                        echo "<script type='text/javascript'> alert('Ime za prikaz je zauzeto!'); </script>";
                    else
                     if ($log_data[1] != $log_data[2])
                              echo "<script type='text/javascript'> alert('Lozinke se ne podudaraju!'); </script>";
                     else {*/
		
           	
           	$paket = 0;
			
			$uspjeh = insert_into_tvrtke( $_SESSION["id"], $_SESSION["array1"][0], $_SESSION["array1"][3], $_SESSION["array1"][4], $_SESSION["array1"][5], $_SESSION["array2"][1],
										  $_SESSION["array2"][2], $_SESSION["array2"][3], $_SESSION["array2"][4], $_SESSION["array3"][9], $_SESSION["array2"][5],
										  $_SESSION["array3"][0], $_SESSION["array3"][1], $_SESSION["array3"][2], $_SESSION["array3"][3], $_SESSION["array3"][7],
										  $_SESSION["array3"][8], $paket );
			
           	if ( $uspjeh ) {
                        //poslati na mail tvrtki nekakve podatke ?
                                /*$to = $log_data[3];
                                $subject = "Aplikacija - Registracija";
                                $message = "Zahvaljujemo na interesu za aplikaciju! \n O statusu zahtjeva bit ćete obaviješteni na email. \n Aplikacija";
                                $headers = "From: VIRIDIS" . "\r\n" .
                                            "Reply-To: valentinadumbov@gmail.com" . "\r\n" .
                                        "X-Mailer: PHP/" . phpversion();

                                mail($to, $subject, $message, $headers);*/
          		echo "<script> alert('uspjesno ubaceno u bazu'); </script>";
          	}
          	else
               echo "<script> alert('Greska'); </script>";
			
			unset( $_SESSION["reg1"] ); unset( $_SESSION["reg2"] ); unset( $_SESSION["array1"]); unset( $_SESSION["array2"]); unset($_SESSION["array3"]);

		  	echo "<script> window.location.href = 'index.php'; </script> ";
		}
    }

	?>


<?php
include_once('partials/footer.php');
?>