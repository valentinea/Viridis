<?php
include_once('partials/header_index.php');
?>




	<!-- kontejner za podatke registracije -->

	
  	<div class="container" style="font-family: 'Asap', sans-serif; color: gray;">

		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="padding-top: 7%">
			
			<div class="form-group">
				<label class="col-sm-3 control-label">SLUŽBENI TELEFON</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="telefon">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">ULICA I KUĆNI BROJ</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="adresa">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">POŠTANSKI BROJ</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="postanski">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">GRAD</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="grad">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">DRŽAVA</label>
				<div class="col-sm-7 input_za_reg">
					<select name="drzava">
						<option value="0" ></option>
    					<option value="Hrvatska" > Hrvatska </option>
    					<option value="Bosna i Hercegovina" > Bosna i Hercegovina </option>
    					<option value="Slovenija" > Slovenija </option>
    					<option value="Srbija" > Srbija </option>
    					<option value="Mađarska" > Mađarska </option>
    					<option value="Italija" > Italija </option>
    					<option value="Makedonija" > Makedonija </option>
    					<option value="Austrija" > Austrija </option>
    					<option value="Crna Gora" > Crna Gora </option>
  					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">JEZIK</label>
				<div class="col-sm-7 input_za_reg">
					<select name="jezik">
						<option value="0" ></option>
    					<option value="hrvatski" > hrvatski </option>
    					<option value="slovenski" > slovenski </option>
    					<option value="srpski" > srpski </option>
    					<option value="mađarski" > mađarski </option>
    					<option value="talijanski" > talijanski </option>
    					<option value="makedonski" > makedonski </option>
    					<option value="njemački" > njemački </option>
  					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-1 col-sm-offset-10">
				<input type="submit" name="submit2" value="" id="registracija_nastavak" class="pull-right" >
				</div>
			</div>
		</form>
	</div>




<?php		

	/* provjera je li user već ulogiran ili admin */
	if( isset( $_SESSION["user"] ) ) header("Location: /VIRIDIS/profil.php");
	if( ! isset( $_SESSION["reg1"]) ) echo "<script> window.location.href = 'index.php'; </script> ";

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

		if( isset($_POST["submit2"]) ) {		// isset($_GET["d"]) && isset($_GET["j"])

			if( $_POST["telefon"]=="" || $_POST["adresa"]=="" || $_POST["postanski"]=="" || $_POST["grad"]=="" || $_POST["drzava"]=="0" || $_POST["jezik"]=="0"  )
				echo  "<script type='text/javascript'> alert('Niste unijeli sve podatke!'); </script>";
			else {
				
			$log_data = array ( $_POST["telefon"], $_POST["adresa"], $_POST["postanski"], $_POST["grad"], $_POST["drzava"], $_POST["jezik"] );

			
			$uspjeh = insert_into_kontakti( $_SESSION["id"], $_POST["telefon"] );
			
			$log_data = ocisti($log_data);

			//uspoređivati postoji li išta istog
 
      /*      if (find_username ($log_data[0]))
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
                     else { */
                     
			if( $uspjeh ){
				echo "<script> alert('uspjesno ubaceno u bazu'); </script>";
          		$_SESSION["array2"] = $log_data;
            	$_SESSION["reg2"] = 1;
            	echo "<script> window.location.href = 'registracija3.php'; </script> ";
			}
          	else
               echo "<script> alert('Greska'); </script>";
            
            
			
			}
        } 

	?>


<?php
include_once('partials/footer.php');
?>