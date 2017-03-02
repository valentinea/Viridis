<?php
session_start();
include('baza/spajanje_na_bazu.php');
?>

<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<title> Aplikacija </title>

	<!-- za bootstrap -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	


  	<!-- stil -->
  	<link rel="stylesheet" type="text/css" href="style/style_index.css">

</head>

<body class="admin-background-color">
	
<?php
	/* provjera je li user već ulogiran ili admin */
	if( isset( $_SESSION["user"] ) ) header("Location: /VIRIDIS/admin/profil.php");	
?>

<!-- kontejner za naslov i loginić -->
	<nav>
		<div class="row" id="naslov_login_div">
			<div id="logo_index">
				<a href="index.php" id="logo_link">
					<img src="/VIRIDIS/style/logo_1.png" id="logo_1" height="400" width="193">
				</a>		
			</div>
			<!-- login forma -->
			<div id="reg_login" class="pull-right">
				<!-- klik za registraciju -->
				
				<a href="paketi.php" id="registracija_link">
					<span id="reg_span" class="pull-left">Registrirajte se</span>
				</a>
				
				<a href="login.php" id="login_link">
					<span id="login_span" class="pull-right">Prijava</span>
				</a>
			</div>
		</div>
	</nav>