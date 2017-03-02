<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>

<input type='text' id="trazilica" placeholder='Unesite' />
	<div class="dropdown">
		<button id="pretrazi" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ne još
			<span class="caret"></span>
		</button>
		<ul class="dropdown-menu">
			<li onclick='trazi(1)'> Datum </li>
			<li onclick='trazi(2)'> Ime </li>
			<li onclick='trazi(3)'> Voditelj </li>
			<li onclick='trazi(4)'> Grad </li>
		</ul>
	</div>


	<div id="projekti" style="width:30%; position:absolute; margin-left:10%;">
		
		<table class="table-bordered">
			<thead>
				<tr>
					<th style='width:20%;'>Ime naloga</th>
					<th style='width:20%;'>Opis</th>
					<th style='width:20%;'>Početak</th>
					<th style='width:20%;'>Za površinu</th>
					<th style='width:20%;'>Akcije</th>
				</tr>
			</thead>
			<tbody>
		
			<?php
	
			$projekti = get_podaci_tvrtke_projekti($_SESSION["user"]);
	 		$dulj1 = sizeof($projekti);
			$dulj2 = sizeof($projekti[0]);		//$i, prezime, ime, email, pozicija
			$i = 0;
			$j = 0;

			
			while( $i<$dulj1 ){ 
			?>
			
				<tr>
					<td><?php echo($projekti[$i][1]); ?></td>>
					<td><?php echo($projekti[$i][2]); ?></td>>
					<td><?php echo($projekti[$i][3]); ?></td>>
					<td><?php echo( get_area_data( $projekti[$i][0])->fetch_array(MYSQLI_ASSOC)['ime'] ); ?></td>
					<td></td>>
				</tr>
				
			<?php	
			$i++;
			} 
			?>
			
			</tbody>
		</table>

	</div>


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


<?php
include_once('../partials/footer.php');
?>
