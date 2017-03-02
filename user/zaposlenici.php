<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
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
	</div>
	
	<table >
		<thead>
			<tr>
				<th style='width:20%;'>Prezime</th>
				<th style='width:20%;'>Ime</th>
				<th style='width:20%;'>E-mail</th>
				<th style='width:20%;'>Pozicija</th>
				<th style='width:20%;'>obrada nekakva</th>
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
			 	
			 <td> <button id="btn<?php echo $zaposlenici[$i][0]; ?>" onclick='salji_mail("<?php echo $zaposlenici[$i][3]; ?>", "<?php echo $zaposlenici[$i][0];?>");'>Pošalji mail za acc</button></td>
			 <?php 
			 $i++; ?>
			 </tr> <?php
		}
?>
		
		</tbody>
	</table>

</div>
</div>


<?php
include_once('../partials/footer.php');

?>
