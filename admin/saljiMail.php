<?php
if( isset($_POST["email"]) ){
	
	// echo "<script> alert('mail: ". $_POST['email'] ."'); </script>";
	
	
	$to = "";
	$to .= $_POST["email"];
	
    $subject = "Aplikacija GREEAT";
    $message = "Proba";
    $headers = "From: GREEAT" . "\r\n" .
                "Reply-To: valentinadumbov@gmail.com" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();
    
    if( mail($to, $subject, $message, $headers) ) {
     //   echo" <script> alert('uspjesno poslan mail'); </script>";
        echo('{"response": "OK", "email": "'.$to.'"}');
    }
}

?>