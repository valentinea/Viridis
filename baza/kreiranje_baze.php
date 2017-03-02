<?php
$servername = 'localhost';
//za wamp podaci:
$username = 'root';
$password = '';
$database = "VIRIDIS";

	//uspostavljanje konekcije, mysqli_connect alias je od mysqli::__construct
	$conn = new mysqli ($servername, $username, $password)
		or die ("Connection failed: ".mysqli_connect_error()); //vraća string description zadnjeg errora
	//stvaranje baze
	
	$brisanje = "DROP DATABASE VIRIDIS;";
	
	if ($conn->query($brisanje))
		echo "Db deleted successfully!</br>";
	else
		echo "Db didn't even exist :P </br>";
	
	$query = "CREATE DATABASE VIRIDIS";
	
	if ($conn->query($query))
		echo "Db created successfully!</br>";
	else
		echo "Error creating db: ".$conn->error."</br>";
	
	$conn->select_db($database);

	if( !$conn->select_db($database) ) {
		echo "Error selecting db: ".$conn->error."</br>";
	}
	else echo "Database ok"."</br>";

	$tvrtke = "CREATE TABLE TVRTKE (
		tid INT,
		naziv VARCHAR(50),
		godosnutka INT,
		vlasnik VARCHAR(50),
		webadresa VARCHAR(100),
		adresa VARCHAR(80),
		postanski INT,
		grad VARCHAR(50),
		drzava VARCHAR(50),
		zupanija VARCHAR(40),
		jezik VARCHAR(20),
		oib INT,
		mbs INT,
		mibpg INT,
		djelatnost INT,
		valuta VARCHAR(10),
		porez INT,
		paket INT,
		primary key (tid), key(naziv));";

	$accounti = "CREATE TABLE ACCOUNT (
		type INT,
		aid INT,
		email VARCHAR(50),
		autentikacija VARCHAR(50),
		primary key (aid), key(email));";
		
	$kontakti = "CREATE TABLE KONTAKTI (
		id INT,
		telefon INT NULL,
		tel2 INT NULL,
		tel3 INT NULL,
		primary key (id))";

	$racuni = "CREATE TABLE RACUNI (
		rid INT,
		tid INT,
		banka VARCHAR(30),
		racun INT,
		emailracuna VARCHAR(50),
		primary key (rid), key(tid));";
		
	$zaposlenici = "CREATE TABLE ZAPOSLENICI (
		zid INT,
		tid INT,
		email VARCHAR(50),
		ime VARCHAR(20),
		prezime VARCHAR(20),
		oib INT,
		adresa VARCHAR(50),
		postanski INT(5),
		grad VARCHAR(50),
		drzava VARCHAR(50),
		datumrod DATE,
		pozicija VARCHAR(30),
		primary key (zid), key(tid));";
		
	$povrsina = "CREATE TABLE POVRSINE (
		mid INT,
		tid INT,
		ime VARCHAR(100),
		opis TEXT,
		primary key(mid), key(tid));";
		
	$koordinate = "CREATE TABLE KOORDINATE (
		cid INT,
		mid INT,
		x FLOAT,
		y FLOAT,
		primary key(cid), key(mid));";
	
	$projekti = "CREATE TABLE PROJEKTI (
		pid INT,
		tid INT,
		mid INT,
		ime VARCHAR(50),
		pocetak DATE,
		kraj DATE,
		trajanje TIME,
		opis TEXT,
		primary key(pid), key(tid, mid));";

	$slike = "CREATE TABLE SLIKE (
		id INT,
		mid INT,
		url MEDIUMTEXT,
		primary key(id), key(mid));";
	
	$strojevi = "CREATE TABLE STROJEVI (
		sid INT,
		tid INT,
		naziv VARCHAR(50),
		stanje VARCHAR(100),
		radnihsati FLOAT,
		primary key(sid), key(tid));";
	
	$projektradnici = "CREATE TABLE PROJEKT_RADNICI (
		zid INT,
		pid INT,
		primary key(zid, pid));";
	
	$projektstrojevi = "CREATE TABLE PROJEKT_STROJEVI (
		sid INT,
		pid INT,
		primary key(sid), key(pid));";

	$useri = "CREATE TABLE USERS (
		uid INT,
		tid INT,
		email VARCHAR(50),
		primary key(uid), key(pid));";
	
//koje dodatne podatke imaju baš korisnici?


//zaposlenici, reklame

	if ($conn->query($tvrtke))
		echo "Table TVRTKE created successfully!</br>";
	else
		echo "Error creating TVRTKE table: ".$conn->error."</br>";
	
	if ($conn->query($accounti))
		echo "Table ACCOUNTI created successfully!</br>";
	else
		echo "Error creating ACCOUNTI table: ".$conn->error."</br>";
		
	if ($conn->query($kontakti))
		echo "Table KONTAKTI created successfully!</br>";
	else
		echo "Error creating KONTAKTI table: ".$conn->error."</br>";
		
	if ($conn->query($racuni))
		echo "Table RACUNI created successfully!</br>";
	else
		echo "Error creating RACUNI table: ".$conn->error."</br>";

	if ($conn->query($zaposlenici))
		echo "Table ZAPOSLENICI created successfully!</br>";
	else
		echo "Error creating ZAPOSLENICI: ".$conn->error."</br>";
	
	if ($conn->query($povrsina))
		echo "Table POVRSINA created successfully!</br>";
	else
		echo "Error creating POVRSINA: ".$conn->error."</br>";
		
	if ($conn->query($koordinate))
		echo "Table KOORDINATE created successfully!</br>";
	else
		echo "Error creating KOORDINATE: ".$conn->error."</br>";
		
	if ($conn->query($projekti))
		echo "Table PROJEKTI created successfully!</br>";
	else
		echo "Error creating PROJEKTI: ".$conn->error."</br>";
	
	if ($conn->query($slike))
		echo "Table SLIKE created successfully!</br>";
	else
		echo "Error creating SLIKE: ".$conn->error."</br>";
	
	if ($conn->query($strojevi))
		echo "Table STROJEVI created successfully!</br>";
	else
		echo "Error creating STROJEVI: ".$conn->error."</br>";
	
	if ($conn->query($projektradnici))
		echo "Table PROJEKTRADNICI created successfully!</br>";
	else
		echo "Error creating PROJEKTRADNICI: ".$conn->error."</br>";
	
	if ($conn->query($projektstrojevi))
		echo "Table PROJEKTSTROJEVI created successfully!</br>";
	else
		echo "Error creating PROJEKTSTROJEVI: ".$conn->error."</br>";
	
	
	
	
	
	$primjer1 = "INSERT INTO TVRTKE SET tid=1, naziv='x', godosnutka=1, vlasnik='x', webadresa='x', adresa='x', postanski=1, grad='Zagreb', drzava='Hrvatska', zupanija='Grad Zagreb',"
				."jezik='hrvatski', oib=11111111111, mbs=1, mibpg=1, djelatnost=1, valuta='x', porez=1, paket=0;";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
		
	$primjer1 = "INSERT INTO ACCOUNT SET type=0, aid=1, email='x@mail.com', autentikacija='x';";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO ACCOUNT SET type=1, aid=2, email='x1@mail.com', autentikacija='x1';";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO ACCOUNT SET type=1, aid=3, email='x2@mail.com', autentikacija='x2';";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO KONTAKTI SET id=1, telefon=1;";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO RACUNI SET tid=1, rid=5, banka='x', racun=1, emailracuna='x@mail.com';";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO ZAPOSLENICI SET email='x1@mail.com', zid=2, tid=1, ime='xa', prezime='xa', oib=3, adresa='xa', postanski=11111, grad='Zagreb', drzava='Hrvatska', datumrod='1990-01-01', pozicija='boss';";
	
	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
		
	$primjer1 = "INSERT INTO ZAPOSLENICI SET email='x2@mail.com', zid=3, tid=1, ime='a', prezime='a', oib=1, adresa='a', postanski=11111, grad='a', drzava='a', datumrod='2000-01-01', pozicija='menader';";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
		
	$primjer1 = "INSERT INTO ZAPOSLENICI SET email='x3@mail.com', zid=4, tid=1, ime='b', prezime='b', oib=2, adresa='b', postanski=22222, grad='b', drzava='b', datumrod='2000-02-02', pozicija='bog_i_batina';";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";

	$primjer1 = "INSERT INTO PROJEKTI SET tid=1, pid=11, mid=111, ime='prvi', pocetak='2016-03-03', kraj='2016-05-05', trajanje=1500, opis='Pa to će biti krasan projekt!';";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
	
	$primjer1 = "INSERT INTO PROJEKTI SET tid=1, pid=12, mid=122, ime='drugi', pocetak='2016-04-04', kraj='2016-06-06', trajanje=1300, opis='Pa to će biti loš projekt!';";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
	
	$primjer1 = "INSERT INTO PROJEKTI SET tid=1, pid=13, mid=133, ime='treći', pocetak='2016-07-07', kraj='2016-08-08', trajanje=500, opis='Pa to će biti kratki projekt!';";

	if ($conn->query($primjer1))
		echo "primjer created successfully!</br>";
	else
		echo "Error creating primjer: ".$conn->error."</br>";
?>
