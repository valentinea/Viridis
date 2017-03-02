<?php

    $conn = mysqli_connect("localhost", "denix00", "") or die("Neuspio spoj na bazu");
    
    $select_db = mysqli_select_db($conn, "greeat") or die("Neuspjelo selektiranje baze");
    
    //mysqli_set_charset($conn,"cp1250") or die("Neuspjeli charset");
    
    $query = "select Povrsine.id idP, ime naziv, opis, lat, lng from Korisnici 
                join TVRTKE_OSNOVNO on Korisnici.idTvrtka = TVRTKE_OSNOVNO.cid
                join Povrsine on TVRTKE_OSNOVNO.cid = Povrsine.idTvrtka
                join Koordinate on Koordinate.idPovrsina = Povrsine.id
                where Korisnici.id = 1";
    
    $result = mysqli_query($conn, $query);
    
    //algoritam za generiranje JSON-a iz upita iz baze
    
    echo('{"parkovi":[{');
    
    $nazivTemp = '';
    $zarez = 0;
    while($row = mysqli_fetch_array($result)){
            if($nazivTemp != $row['naziv'])
            {
                //ako je novi naziv
                if($nazivTemp != ''){
                    echo(']},');
                //    echo("<br/><br/>");
                    echo('{');
                }
                echo('"naziv":' . '"' . $row["naziv"] . '",');
                echo('"id":' . '"' . $row["idP"] . '",');
                echo('"opis":' . '"' . $row["opis"] . '",');
                $nazivTemp = $row['naziv'];
                
                echo('"koordinate":[');
                $zarez = 0;
            }
            if($zarez == 1)
                echo(',{');
            else 
                echo("{");
            
            echo('"lat":' . $row["lat"] . ',');
            echo('"lng":' . $row["lng"]);
            echo("}");
            
            $zarez = 1;
                
    }
    echo("]}");
    echo("]}");
    
    //kraj algoritma za JSON
?>