<?php
session_start();
include('baza/spajanje_na_bazu.php');
	/* provjera je li user već ulogiran ili admin */
	if( isset( $_SESSION["user"] ) ) header("Location: /VIRIDIS/admin/profil.php");	
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

	<!-- kontejner za naslov -->
    <nav>
		<div class="row" id="naslov_login_div">
			<div id="logo_index">
				<a href="index.php"> <img src="/VIRIDIS/style/logo_1.png" id="logo_1" > </a>
			</div>
			<!-- login forma -->
			<div id="samo_reg"  class="pull-right">

				<a href="paketi.php" id="registracija_link">
					<span id="reg_span" class="pull-left">Registrirajte se</span>
				</a>
			</div>
		</div>
	</nav>


	<!-- login forma -->
	<div id="login_forma">
    	<ul>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline" role="form">
  				<div class="form-group" style="	font-family: 'Asap', sans-serif; font-weight: 700;">
					EMAIL <input type="text" class="form-control" name="email" style="border-radius: 25px;" >
  				</div>
  				<!-- nakon što se submita, poziva se ta forma opet dolje: -->
  				<div class="form-group" style="	font-family: 'Asap', sans-serif; font-weight: 700;">
					LOZINKA <input type="password" class="form-control" name="password" style="border-radius: 25px;" >
  				</div>
				<input type="submit" id="login_but" class="btn-link" name="login" value="Login" >
		</form>
        </ul>
    </div>

<?php
		/* nakon unosa logina */

		if( isset($_POST["login"]) ) {

			if( $_POST["email"]=="" || $_POST["password"]=="" )
				echo "<script type='text/javascript'> alert('Niste unijeli sve podatke!'); </script>";

			else if( find_email($_POST["email"])<0 )
					echo "<script type='text/javascript'> alert('E-mail ne postoji!'); </script>";
			else if( !check_password ($_POST["email"], $_POST["password"]) ) {
                    echo "<script type='text/javascript'> alert('Lozinka nije u redu!'); </script>";
                    }
			else {
				$_SESSION["user"] = get_user_by_email( $_POST["email"], find_email($_POST["email"]) );
				
				if( find_email($_POST["email"])==0 ){
					$_SESSION["type"] = 0;
					echo "<script> window.location.href = 'admin/profil.php'; </script> ";
				}
				else if( find_email($_POST["email"])==1 ){
					$_SESSION["type"] = 1;
					echo "<script> window.location.href = 'user/profil.php'; </script> ";
				}
				else if( find_email($_POST["email"])==2 ){
					$_SESSION["type"] = 2;
					echo "<script> window.location.href = 'admin2/profil.php'; </script> ";
				}
				else if( find_email($_POST["email"])==3 ){
					$_SESSION["type"] = 3;
					echo "<script> window.location.href = 'user2/profil.php'; </script> ";
				}
				
			}
		} 
	?>

<?php
include_once('partials/footer.php');
?>