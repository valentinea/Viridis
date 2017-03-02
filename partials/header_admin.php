<?php
session_start();
include('../baza/spajanje_na_bazu.php');
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
  	<link rel="stylesheet" type="text/css" href="../style/style_admin.css">
  	

</head>

<body class="admin-background-color">




<?php
	/* provjera je li user već ulogiran ili admin */
	if( !isset( $_SESSION["user"] ) ) header("Location: ../index.php");
	else if( isset($_POST["logout"] ) ){
		session_unset();
		session_destroy();
		header("Location: ../index.php");
	}
?>


	
	<!-- kontejner za login -->
	
	<nav id="profil_nav" >
    	<a href="index.php" > <img src="../style/logo_1.png" id="logo_2"> </a>
    	<a href="profil.php" style="margin-left:10%; text-decoration:none; color:black;"> <?php echo $_SESSION["user"]; ?> </a>
		<!-- profil -->
		<div class="dropdown" style="float:right; margin-right:10%; margin-top:2px;">
			<img src="../style/profil-14.png" class="img-circle" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        	moje ime, administrator
			  <ul class="dropdown-menu">
			    <li><a href="account.php">Account</a></li>
			    <li><a href="#"><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<input type="submit" id="logout" name="logout" value="Logout"></form></a></li>
			    <li><a href="#">nešto</a></li>
			  </ul>
		</div>
    </nav>