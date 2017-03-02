<?php
include_once('../partials/header_admin.php');
include_once('menu_admin.php');
?>


	      <?php echo podaci(); ?>
	      
	    </div>
	   
	    
	  </div>
	    

	
	<?php

		function podaci(){
			$tvrtke = get_podaci_tvrtke( $_SESSION["user"] );		//je array
			
			$table = "<table class='table table-hover' >
						<thead>
							<tr>
								<th style='width:12.5%;'> ID </th>
								<th style='width:12.5%;'> NAZIV </th>
								<th style='width:12.5%;'> EMAIL </th>
								<th style='width:12.5%;'> AUTENTIKACIJA </th>
								<th style='width:12.5%;'> GODINA OSNUTKA </th>
								<th style='width:12.5%;'> VLASNIK </th>
								<th style='width:12.5%;'> WEB </th>
								<th style='width:12.5%;'> PAKET </th>
							</tr>
	      				</thead>
	      				<tbody>
	      					<tr>
								<th style='width:12.5%;'> ". $tvrtke[0] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[1] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[2] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[3] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[4] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[5] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[6] ." </th>
								<th style='width:12.5%;'> ". $tvrtke[7] ." </th>
	        				</tr>
	      				</tbody>
	      				</table>
	      			  ";
	      	return $table;
		}

?>



<?php
include_once('../partials/footer.php');
?>
