<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>

<?php
	
	//globalne varijable
    $tvrtkaId;
    $povrsinaId;
    $povrsinaNaziv;
    $povrsinaOpis;
	
	
    //pri otvaranju povrsine prikazuju se njezini podaci
	if(isset($_GET["i"]) ){
	            //dohvacanje podataka iz baze o pojedinom parku
	    $conn = mysqli_connect("localhost", "denix00", "") or die("Neuspio spoj na bazu");
	    
	    $select_db = mysqli_select_db($conn, "greeat") or die("Neuspjelo selektiranje baze");
	    
	   // mysqli_set_charset($conn,"cp1250") or die("Neuspjeli charset");
	    
	    $query = 'SELECT TVRTKE_OSNOVNO.cid, Povrsine.id, Povrsine.ime, Povrsine.opis FROM Povrsine
	                JOIN TVRTKE_OSNOVNO ON TVRTKE_OSNOVNO.cid = Povrsine.idTvrtka
	                JOIN Korisnici ON TVRTKE_OSNOVNO.cid = Korisnici.idTvrtka
	                WHERE Korisnici.id = 1
	                AND Povrsine.id = ' . $_GET["i"] . ';';
	    
	    //echo($query); //ispis queryja za kontrolu
	    $result = mysqli_query($conn, $query) or die("Neuspio select");
	    
	            	 //mozda ce biti potrebna petlja, mozda ne u buducnosti. Zasad je nepotrebna, ali radi
    	while ($row = mysqli_fetch_array($result)) {
    		        $tvrtkaId = $row['cid'];
    				$povrsinaId = $row['id'];
    				$povrsinaNaziv = $row['ime'];
					$povrsinaOpis = $row['opis'];
    	}
    
    //update povrsine
    }else if(isset($_POST['naziv'])){
    	$povrsinaNaziv = $_POST['naziv'];
    	$povrsinaOpis = $_POST['opis'];
    	$tvrtkaId = $_POST['cid'];
    	$povrsinaId = $_POST['id'];
	    	
	    $conn = mysqli_connect("localhost", "denix00", "") or die("Neuspio spoj na bazu");
	    
	    $select_db = mysqli_select_db($conn, "greeat") or die("Neuspjelo selektiranje baze");
	    
	   // mysqli_set_charset($conn,"cp1250") or die("Neuspjeli charset");
	    
	    //query za unos podataka
	    $query = 'UPDATE `Povrsine` SET `ime`= "'.$povrsinaNaziv.'",`opis`="'.$povrsinaOpis.'" WHERE id = '.$povrsinaId.' and idTvrtka = '.$tvrtkaId.';';
	    
	    //echo($query); //ispis queryja za kontrolu
	    $result = mysqli_query($conn, $query) or die("Neuspio update");
	    	
    }else{
    	header("Location: /VIRIDIS/kartaPovrsina.php");
    }
    

?>

	      
        <div class="container">
        	<div class="row">
			<form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="width:50%;">
				
				<input type="hidden" name="cid" value="<?php echo($tvrtkaId); ?>"/>
				<input type="hidden" name="id" value="<?php echo($povrsinaId); ?>"/>
		
				<div class="form-group">
					<label class="col-sm-2 control-label"> Naziv površine </label>
					<div class="col-sm-10">
						<input class="form-control" id="focusedInput" type="text" placeholder="<?php echo($povrsinaNaziv); ?>" name="naziv">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"> Opis povrsine </label>
					<div class="col-sm-10">
						<textarea rows="10" name="opis" class="form-control"><?php echo($povrsinaOpis); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"> </label>
					<div class="col-sm-10">
						<input type="submit" value="Spremi" class="btn btn-primary" />
					</div>
				</div>
			</form>
			</div>
        </div>
        

	    
	  </div>
	</div>




<?php
include_once('../partials/footer.php');
?>