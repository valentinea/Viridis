<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>

<input type='text' id="trazilica" placeholder='Unesite' />
	<div class="dropdown">
		<button id="pretrazi" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pretraži
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li onclick='trazi(1)'> Datum </li>
			<li onclick='trazi(2)'> Ime </li>
			<li onclick='trazi(3)'> Voditelj </li>
			<li onclick='trazi(4)'> Grad </li>
		</ul>
		<button type="button" class="btn btn-success pull-right" style="margin-right:20px;" data-toggle="modal" data-target="#novi_projekt">Novi projekt</button>
	</div>


<?php

	if( isset($_GET["search"]) && isset($_GET["x"])  ) { 
		  $projekti = get_podaci_tvrtke_projekti_2($_SESSION["user"], $_GET["search"], $_GET["x"]); }
	else{ $projekti = get_podaci_tvrtke_projekti($_SESSION["user"]); }
	
?>
	
	<!--<div id="projekti" style="width:76%; position:absolute; margin-left:2%; ">-->
		
		<?php
		
		if( (!isset($_GET["pid"]) && !isset($_SESSION["pid"])) || isset($_GET["vs"]) ){
		
			unset($_SESSION["pid"]);
			
			?><table class="table" id="popis_projekata"> <tbody>
			<?php

	 		$dulj1 = sizeof($projekti);
			$dulj2 = sizeof($projekti[0]);		//$pid, $row["ime"], $row["opis"], $row["pocetak"], $row["kraj"], $row["trajanje"]
			$i = 0;
			$j = 0;
			
			for($i=0; $i<$dulj1; $i++){ ?>
				 <tr style="cursor: pointer;"><?php
			     echo '<td onclick="open_pro('.$projekti[$i][0].')">'.$projekti[$i][3].'</td>';
			     echo '<td onclick="open_pro('.$projekti[$i][0].')">'.$projekti[$i][1].'</td>';
			     ?></tr><?php
			}
			
			?></tbody> </table><?php
		}
		else if( isset($_GET["pid"]) || isset($_SESSION["pid"]) ){
			
			if( !isset($_SESSION["pid"]) ) $_SESSION["pid"] = $_GET["pid"];
			
			$projekt = get_podaci_tvrtke_projekt($_SESSION["user"], $_SESSION["pid"]);

			echo "<script> alert('".$projekt[3]."'); </script>";
			echo "<p>NAZIV:<br>".$projekt[3]."</p><br><tr><br>";
			echo "<p>VRIJEME:<br>".$projekt[4]." - ".$projekt[5]."</p><br><tr><br>";
			echo "<p>OPIS:<br>".$projekt[7]."</p><br><tr><br>";
			echo "<button onclick='vrati_se()'>Back</button>";
			
		}
		
		?>
	<!--</div>-->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="novi_projekt">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Novi projekt</h4>
            </div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                <div class="modal-body">
                	
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="ime">Ime</label>
                            <input type="text" name="ime" placeholder="Ime" id="ime" class="form-control" required/>
                    	</div>
                    	
                    	<div class="form-group col-md-6">
                            <label for="pocetak">Početak</label>
                            <input type="date" name="pocetak" placeholder="Početak" id="pocetak" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<div class="form-group col-md-6">
                            <label for="kraj">Kraj</label>
                            <input type="date" name="kraj" placeholder="Kraj" id="kraj" class="form-control" required/>
                    	</div>

                    	<div class="form-group col-md-6">
                            <label for="povrsina">Površina</label>
                            <input type="text" name="povrsina" placeholder="Površina" id="povrsina" class="form-control" required/>
                        </div>
                    </div>
                    
                    <div class="row">
	                    <div class="form-group col-md-6">
                            <label for="adresa">Opis</label>
                            <input type="text" name="opis" placeholder="Opis" id="opis" class="form-control" required/>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    <input type="submit" name="noviProjekt" class="btn btn-primary" value="Spremi"/>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
	
	function open_pro(i){

		var xhr = new XMLHttpRequest();

    	xhr.onreadystatechange = function() {
       	if( xhr.readyState == 4 && xhr.status == 200 ) {
         document.body.innerHTML = "";
            document.body.innerHTML = xhr.responseText;
           }
        };

       xhr.open( "GET", "projekti.php?pid=" + i, true );
       
       xhr.send();
	}
	
	function vrati_se(){
		var xhr = new XMLHttpRequest();

    	xhr.onreadystatechange = function() {
       	if( xhr.readyState == 4 && xhr.status == 200 ) {
         document.body.innerHTML = "";
            document.body.innerHTML = xhr.responseText;
           }
        };

       xhr.open( "GET", "projekti.php?vs=1", true );
       
       xhr.send();
	}
	
	function trazi(i){
		
		var unos = document.getElementById("trazilica").value;
		
		var kriterij;

		if( i==1 ) kriterij = "datum";
		else if( i==2 ) kriterij = "ime";
		else if( i==3 ) kriterij = "voditelj";
		else if( i==4 ) kriterij = "grad";


	 	var xhr = new XMLHttpRequest();

    	xhr.onreadystatechange = function() {
       	if( xhr.readyState == 4 && xhr.status == 200 ) {
         document.body.innerHTML = "";
            document.body.innerHTML = xhr.responseText;
           }
        };

       xhr.open( "GET", "projekti.php?search=" + kriterij + "&x=" + unos, true );
       
       xhr.send();
	}
	

		
</script>


<?php
include_once('../partials/footer.php');
?>