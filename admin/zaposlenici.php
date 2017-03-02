<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>


<?php 

if( isset($_POST["noviZaposlenik"]) ) {
			$polje_podataka = array();
			
            $polje_podataka[0] = $_POST['ime'];
            $polje_podataka[1] = $_POST['prezime'];
            $polje_podataka[2] = $_POST['email'];
            $polje_podataka[3] = $_POST['oib'];
            $polje_podataka[4] = $_POST['adresa'];
            $polje_podataka[5] = $_POST['pbr'];
            $polje_podataka[6] = $_POST['grad'];
            $polje_podataka[7] = $_POST['drzava'];
            $polje_podataka[8] = $_POST['datRodenja'];
            $polje_podataka[9] = $_POST['pozicija'];
            
            insert_zaposlenik($polje_podataka);
            
            unset($_POST["noviZaposlenik"]);
        }

?>

<?php

	if( isset($_GET["search"]) && isset($_GET["x"])  ) { $zaposlenici = get_podaci_tvrtke_zaposlenici_2($_SESSION["user"], $_GET["search"], $_GET["x"] ); }
	else{ $zaposlenici = get_podaci_tvrtke_zaposlenici($_SESSION["user"]); }
	
?>


<script type="text/javascript">
		
	function trazi(i){
		
		var unos = document.getElementById("trazilica").value;
		
		var kriterij;
		
		if( i==1 ) kriterij = "prezime";
		else if( i==2 ) kriterij = "ime";
		else if( i==3 ) kriterij = "pozicija";
		else if( i==4 ) kriterij = "grad";
		else if( i==5 ) kriterij = "email";
	
	 	var xhr = new XMLHttpRequest();

    	xhr.onreadystatechange = function() {
       	if( xhr.readyState == 4 && xhr.status == 200 ) {
         document.body.innerHTML = "";
            document.body.innerHTML = xhr.responseText;
           }
        };

       xhr.open( "GET", "zaposlenici.php?search=" + kriterij + "&x=" + unos, true );
       
       xhr.send();
	}
	
	function salji_mail(email, id){
      console.log("pocetak ajaxa");
      
        $.ajax({      
              url: 'saljiMail.php', 
           	  method:'POST',
           	  dataType:'JSON',
              data: 'email=' + email,                      
              success: function(data)          
              {
              	if(data.response == "OK"){
              		console.log("mail poslan na email: " + data.email);	
              		var idSpana = 'btn' + id;
                  document.getElementById(idSpana).innerHTML = "Email poslan";
              	}
    	       },
              error: function(jqXHR, textStatus, errorThrown)
              {
                  console.log("Error:" + errorThrown);
              }
        });
        console.log("zavrsetak ajaxa");
    } 
		
</script>

	<input type='text' id="trazilica" placeholder='Unesite'/>
	<div class="dropdown">
	    <button id="pretrazi" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pretraži
	    <span class="caret"></span>
	    </button>
	    	<ul class="dropdown-menu">
		      <li onclick='trazi(1)'> Prezime </li>
		      <li onclick='trazi(2)'> Ime </li>
		      <li onclick='trazi(3)'> Pozicija </li>
		      <li onclick='trazi(4)'> Grad </li>
		      <li onclick='trazi(5)'> E-mail </li>
		    </ul>
	    <button type="button" class="btn btn-success pull-right" style="margin-right:20px;" data-toggle="modal" data-target="#novi_zaposlenik">Novi zaposlenik</button>
	</div>
	
	<table class="table">
		<thead>
			<tr>
				<th style='width:15%;'>Prezime</th>
				<th style='width:15%;'>Ime</th>
				<th style='width:15%;'>E-mail</th>
				<th style='width:15%;'>Pozicija</th>
				<th style='width:15%;'>Obavijest</th>
				<th style='width:20%;'>Akcije</th>
			</tr>
		</thead>
		<tbody>
	
<?php
	 	
 		$dulj1 = sizeof($zaposlenici);
		$dulj2 = sizeof($zaposlenici[0]);		//$i, prezime, ime, email, pozicija
		$i = 0;
		$j = 0;
		
		while( $i<$dulj1 ){
			echo "<tr>";
			for($j=1; $j<5; $j++){ ?>
				<td> <?php echo $zaposlenici[$i][$j]; ?> </td> <?php } ?>
			 	
			 <td> <button class="btn btn-success" id='btn<?php echo $zaposlenici[$i][0]; ?>' onclick='salji_mail("<?php echo $zaposlenici[$i][3]; ?>", "<?php echo $zaposlenici[$i][0];?>");'>Pošalji mail za acc</button></td>
			 <td>
			     <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detalji_zaposlenik">Detalji</button>
			 	 <a href="" class="btn btn-primary" >Uredi</a>
			 	 <a href="" class="btn btn-danger" >Obriši</a>
			 	
			 </td>
			 <?php 
			 $i++; ?>
			 </tr> <?php
		}
?>
		
		</tbody>
	</table>

</div>
</div>

<!--Novi zaposlenik-->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="novi_zaposlenik">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Novi zaposlenik</h4>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                <div class="modal-body">
                	
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ime">Ime</label>
                            <input type="text" name="ime" placeholder="Ime" id="ime" class="form-control" required/>
                    	</div>

                    	<div class="form-group col-md-6">
                            <label for="prezime">Prezime</label>
                            <input type="text" name="prezime" placeholder="Prezime" id="prezime" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email" class="form-control" required/>
                    	</div>

                    	<div class="form-group col-md-6">
                            <label for="oib">OIB</label>
                            <input type="text" name="oib" placeholder="OIB" id="oib" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
	                    <div class="form-group col-md-6">
                            <label for="adresa">Adresa</label>
                            <input type="text" name="adresa" placeholder="Adresu" id="adresa" class="form-control" required/>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="pbr">Poštanski broj</label>
                            <input type="number" name="pbr" placeholder="Poštanski broj" id="pbr" class="form-control" min="10000" max="99999" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="grad">Grad</label>
                            <input type="text" name="grad" placeholder="Grad" id="grad" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
	                    <div class="form-group col-md-6">
                            <label for="drzava">Država</label>
                            <input type="text" name="drzava" placeholder="Država" id="drzava" class="form-control" required/>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="datRodenja">Datum rođenja</label>
                            <input type="date" name="datRodenja" placeholder="Datum rođenja" id="datRodenja" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pozicija">Pozicija</label>
                            <select name="pozicija" id="pozicija" class="form-control">
                                <option value="vozac">Vozač</option>
                                <option value="vrtlar">Vrtlar</option>
                                <option value="kosac">Kosač</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    <input type="submit" name="noviZaposlenik" class="btn btn-primary" value="Spremi"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Novi zaposlenik-->

<!--Update zaposlenika-->

<!--uzeti podatke samo odabranog zaposlenika, dodati placeholdere i promijeniti na update upit-->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="detalji_zaposlenik">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Detalji zaposlenika</h4>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                <div class="modal-body">
                	
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ime">Ime</label>
                            <input type="text" name="ime" placeholder="Ime" id="ime" class="form-control" required/>
                    	</div>

                    	<div class="form-group col-md-6">
                            <label for="prezime">Prezime</label>
                            <input type="text" name="prezime" placeholder="Prezime" id="prezime" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" id="email" class="form-control" required/>
                    	</div>

                    	<div class="form-group col-md-6">
                            <label for="oib">OIB</label>
                            <input type="text" name="oib" placeholder="OIB" id="oib" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
	                    <div class="form-group col-md-6">
                            <label for="adresa">Adresa</label>
                            <input type="text" name="adresa" placeholder="Adresu" id="adresa" class="form-control" required/>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="pbr">Poštanski broj</label>
                            <input type="number" name="pbr" placeholder="Poštanski broj" id="pbr" class="form-control" min="10000" max="99999" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="grad">Grad</label>
                            <input type="text" name="grad" placeholder="Grad" id="grad" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
	                    <div class="form-group col-md-6">
                            <label for="drzava">Država</label>
                            <input type="text" name="drzava" placeholder="Država" id="drzava" class="form-control" required/>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="datRodenja">Datum rođenja</label>
                            <input type="date" name="datRodenja" placeholder="Datum rođenja" id="datRodenja" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pozicija">Pozicija</label>
                            <select name="pozicija" id="pozicija" class="form-control">
                                <option value="vozac">Vozač</option>
                                <option value="vrtlar">Vrtlar</option>
                                <option value="kosac">Kosač</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    <input type="submit" name="updateZaposlenik" class="btn btn-primary" value="Spremi"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Update zaposlenika-->



<?php
include_once('../partials/footer.php');

?>
