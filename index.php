<?php
include_once('partials/header_index.php');
?>



<!--naslov i podnaslov -->
	<div class="container text-center index_naslov_div">
		<div class="row">
			<div id="index_naslov">
				GREEAT
			</div>
			<hr id="index_hr" />
			<div id="index_podnaslov">
				Upravljanje i organizacija održavanja
				<br/>zelenih površina
			</div>
		</div>

<!-- izbornik -->
		<div class="row">
			<div id="index_izbornik_div">
				<a href="#" class="col-md-3 col-sm-6"><div class="izbornik" id="izbornik1"></div></a>
				<a href="#" class="col-md-3 col-sm-6"><div class="izbornik" id="izbornik2"></div></a>
				<a href="#" class="col-md-3 col-sm-6"><div class="izbornik" id="izbornik3"></div></a>
				<a href="#" class="col-md-3 col-sm-6"><div class="izbornik" id="izbornik4"></div></a>
			</div>
		</div>
		
<!--ispobajte pocetni paket -->
		<div class="row">
				<a href="paketi.php" ><div id="index_paket_img"></div></a>
		</div>

	</div>


<?php
include_once('partials/footer.php');
?>

</body>