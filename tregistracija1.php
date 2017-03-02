<?php
include_once('partials/header_index.php');
?>




<!-- kontejner za podatke registracije -->
  	<div class="container">
  		
		<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
			<div class="form-group">
				<label class="col-sm-3 control-label">NAZIV TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="ime">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">E-MAIL TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="email" name="email">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">LOZINKA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="password" name="autentikacija">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">GODINA OSNUTKA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="number" name="godosnutka">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">VLASNIK RAČUNA</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="text" name="vlasnik">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">WEB ADRESA TVRTKE</label>
				<div class="col-sm-7">
					<input class="form-control input_za_reg" id="focusedInput" type="url" name="webadresa">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-1 col-sm-offset-10">
				<input type="submit" name="submit1" value="" id="registracija_nastavak" class="pull-right" >
				</div>
			</div>
		</form>
	</div>

	<?php
	
	/* provjera je li user već ulogiran ili admin */
	if( isset( $_SESSION["user"] ) ) header("Location: /VIRIDIS/profil.php");
	
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

		if( isset($_POST["submit1"]) ) {

			if( $_POST["ime"]=="" || $_POST["email"]=="" || $_POST["autentikacija"]=="" || $_POST["godosnutka"]=="" || $_POST["vlasnik"]=="" || $_POST["webadresa"]==""  )
					echo  "<script type='text/javascript'> alert('Niste unijeli sve podatke!'); </script>";
			else {
				
			$log_data = array ( $_POST["ime"], $_POST["email"], $_POST["autentikacija"], $_POST["godosnutka"], $_POST["vlasnik"], $_POST["webadresa"] );
			
			$log_data = ocisti($log_data);
		
			$id = rand();
			$_SESSION["id"] = $id;
			
			$uspjeh = insert_into_account( 0, $id, $_POST["email"], $_POST["autentikacija"] );

/*			uspoređivati postoji li išta istog
 * 
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

			if( $uspjeh ){
				echo "<script> alert('uspjesno ubaceno u bazu'); </script>";
          		$_SESSION["array1"] = $log_data;
            	$_SESSION["reg1"] = 1;
            	echo "<script> window.location.href = 'registracija2.php'; </script> ";
			}
          	else
               echo "<script> alert('Greska'); </script>";
			
			}
        }

	?>

	
	
<?php
include_once('partials/footer.php');
?>