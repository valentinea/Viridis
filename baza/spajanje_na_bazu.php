<?php
include('baze.php');

$servername = 'localhost';
//za wamp podaci:
$username = 'root';
$password = '';
$database = "VIRIDIS";

	//uspostavljanje konekcije, mysqli_connect alias je od mysqli::__construct
	$conn = new mysqli ($servername, $username, $password)
		or die ("Connection failed: ".mysqli_connect_error()); //vraća string description zadnjeg errora
	//odabir baze
	$conn->select_db($database);
	if( !$conn->select_db($database) ) {
		echo "Error selecting db: ".$conn->error."</br>";
	}
	//else echo "Database ok"."</br>";

?>
