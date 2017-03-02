<?php

function insert_into_tvrtke ( $id, $naziv, $god, $vlasnik, $web, $adr, $post, $grad, $drz, $zup, $jez, $oib, $mbs, $mib, $djl, $valuta, $porez, $paket ) {
	global $conn;

	$query = "INSERT INTO TVRTKE SET tid=". $id .", naziv='". $naziv ."', godosnutka=". $god .", vlasnik='". $vlasnik ."', webadresa='". $web ."', adresa='". $adr
				."', postanski=". $post .", grad='". $grad ."', drzava='". $drz ."', zupanija='". $zup ."', jezik='". $jez ."', oib=". $oib .", mbs=". $mbs
				.", mibpg=". $mib .", djelatnost=". $djl .", valuta='". $valuta ."', porez=". $porez .", paket=". $paket .";";
	
	if ($conn->query($query))
		return 1;
	else
		return 0;
}



function insert_into_account ( $tip, $id, $email, $autentikacija ) {
	global $conn;

	$query = "INSERT INTO ACCOUNT SET type=". $tip .", aid=". $id .", email='". $email ."', autentikacija='". $autentikacija ."';";

	if ($conn->query($query))
		return 1;
	else
		return 0;
}

function insert_into_kontakti( $id, $telefon ) {
	global $conn;

	$query = "INSERT INTO KONTAKTI SET id=". $id .", telefon=". $telefon .";";
	
	if ($conn->query($query))
		return 1;
	else
		return 0;
}

function insert_into_racuni ( $id, $banka, $racun, $emailracuna ){
	global $conn;
	//popraviti rid i tid
	$query = "INSERT INTO RACUNI SET id=". $id .", banka='". $banka ."', racun=". $racun .", emailracuna='". $emailracuna ."';";
	
	if ($conn->query($query))
		return 1;
	else
		return 0;
}

function find_email ( $email ) {
	global $conn;

	$query = "SELECT type FROM ACCOUNT where email='".$email."';";
	$result = $conn->query($query);

    if ($result)
    	while ($rez = $result->fetch_assoc() ){
        		if( $rez['type'] == 0 ) return 0;
        		else if( $rez['type'] == 1 ) return 1;
        		else if( $rez['type'] == 2 ) return 2;
        		else if( $rez['type'] == 3 ) return 3;
        	}

	return -1;
}

function check_password ($username, $password) {
	global $conn;

	$query = "SELECT * FROM ACCOUNT WHERE email = "."'".$username."';";
	$result = $conn->query($query);

    if ($result)
        $user_password = $result->fetch_assoc()['autentikacija'];

	if ($user_password == $password)
		return 1;
		
	else return 0;
}

function get_user_by_email( $email, $tip ){
	global $conn;
	$query = "SELECT aid FROM ACCOUNT WHERE email = "."'".$email."';";
	$result = $conn->query($query);
	
	if ($result)
    	while ($rez = $result->fetch_assoc() )
        	$id = $rez['aid'];
	
	if( $tip==0 ){
		$query = "SELECT naziv FROM TVRTKE WHERE tid=". $id .";";
		$result = $conn->query($query);
		
		if ($result)
	    	while ($rez = $result->fetch_assoc() )
	        	return $rez["naziv"];
	}
	else if( $tip==1 ){
		$query = "SELECT ime FROM ZAPOSLENICI WHERE zid=". $id .";";
		$result = $conn->query($query);
		
		if ($result)
	    	while ($rez = $result->fetch_assoc() )
	    		$imeprez = $rez["ime"];
	    		
	    $query = "SELECT prezime FROM ZAPOSLENICI WHERE zid=". $id .";";
	    $result = $conn->query($query);
		
		if ($result)
	    	while ($rez = $result->fetch_assoc() )
	    		$imeprez .= $rez["prezime"];
	    
	    return $imeprez;
	}
}

function get_id_by_tvrtke( $user ){
	global $conn;
	
	$query = "SELECT tid FROM TVRTKE WHERE naziv='". $user ."';";
	$result = $conn->query($query);
	
	if($result)
		while( $rez = $result->fetch_assoc() ){
			return $rez['tid'];
		}
}



function get_podaci_tvrtke( $user ) {
	global $conn;
	
	$list = array();
	$i = 0;
	$id = get_id_by_tvrtke( $user );
	
	$query = "SELECT * FROM TVRTKE WHERE tid=". $id .";";
	$result = $conn->query($query);
	
	if( $result ){
		$row = $result->fetch_array();
		
		while( $i<8 ){
			array_push( $list, $row[$i++] );
		}
	}
	return $list;
}

function get_podaci_tvrtke_zaposlenici( $user ) {
	global $conn;
	
	$list = array();
	$i = 0;
	$id = get_id_by_tvrtke( $user );
	
	$query = "SELECT * FROM ZAPOSLENICI WHERE tid=". $id .";";
	$result = $conn->query($query);

	if( $result ){
		
		while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
			array_push( $list, array ($i++, $row["prezime"], $row["ime"], $row["email"], $row["pozicija"], $row["oib"], $row["adresa"], $row["postanski"], $row["grad"], $row["drzava"] ));
		}
	}
	return $list;
	
}

function get_podaci_tvrtke_zaposlenici_2($user, $pretraga, $sto){
	global $conn;
	
	$list = array();
	$i = 0;
	$id = get_id_by_tvrtke( $user );
	
	$query = "SELECT * FROM ZAPOSLENICI WHERE tid=". $id ." AND ".$pretraga."='".$sto."';";
	$result = $conn->query($query);

	if( $result ){
		while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
			array_push( $list, array ($i++, $row["prezime"], $row["ime"], $row["email"], $row["pozicija"] ));
		}
	}
	return $list;
}

function get_podaci_tvrtke_projekti($user){
	global $conn;
	
	$list = array();
	$id = get_id_by_tvrtke($user);
	
	$query = "SELECT * FROM PROJEKTI WHERE tid=". $id ." ORDER BY pocetak;";
	$result = $conn->query($query);

	if( $result ){
		while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
			array_push( $list, array ($row["pid"], $row["ime"], $row["opis"], $row["pocetak"], $row["kraj"], $row["trajanje"] ));
		}
	}
	return $list;
}

function get_podaci_tvrtke_projekti_2($user, $pretraga, $sto){
	global $conn;
	
	$list = array();
	$id = get_id_by_tvrtke($user);
	
	$query = "SELECT * FROM PROJEKTI WHERE tid=". $id ." AND ".$pretraga."='".$sto."' ORDER BY pocetak;";
	$result = $conn->query($query);

	if( $result ){
		while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
			array_push( $list, array ($row["pid"], $row["ime"], $row["opis"], $row["pocetak"], $row["kraj"], $row["trajanje"] ));
		}
	}
	return $list;
}

function get_podaci_tvrtke_projekt($user, $pid){
	global $conn;
	
	$list = array();
	$id = get_id_by_tvrtke($user);
	$i = 0;
	
	$query = "SELECT * FROM PROJEKTI WHERE tid=". $id ." AND pid=".$pid.";";
	$result = $conn->query($query);

	if( $result ){
		$row = $result->fetch_array();
		
		while($i<8)
			array_push( $list, $row[$i++] );
	}
	return $list;
}

function get_mail_zaposlenika( $id ){
	global $conn;

	$query = "SELECT email FROM ACCOUNT WHERE aid = ".$id.";";
	$result = $conn->query($query);
	
	if ($result)
    	while ($rez = $result->fetch_assoc() )
        	return $rez['email'];
}

function insert_zaposlenik($podaci){
	global $conn;
	// var_dump($podaci);
	$query = 'INSERT INTO ZAPOSLENICI (tid, ime, prezime, email, oib, adresa, postanski, grad, drzava, datumrod, pozicija)
		VALUES (1, "'.$podaci[0].'", "'.$podaci[1].'", "'.$podaci[2].'", "'.$podaci[3].'", "'.$podaci[4].'", '.$podaci[5].', "'.$podaci[6].'", "'.$podaci[7].'", "'.$podaci[8].'", "'.$podaci[9].'");';
	
	// var_dump($query);

	$result = $conn->query($query);
}

?>
