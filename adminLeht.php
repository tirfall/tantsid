<?php
require_once("conf2.php");
session_start();
ob_start();
//punktid nulliks
if(isset($_REQUEST["punktid0"])){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET punktid=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST["punktid0"]);
    $kask->execute();
}

if(isset($_REQUEST["peitmine"])){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET avalik=0 WHERE id=?");
    $kask->bind_param("i",$_REQUEST["peitmine"]);
    $kask->execute();
}

if(isset($_REQUEST["naitmine"])){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET avalik=1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST["naitmine"]);
    $kask->execute();
}

function isAdmin(){
    return  isset ($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
}
?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tantsud tähtedega</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h1>Tantsud tähtedega</h1>
<?php
include('logimine.php');
include('navigatsioon.php');
?>
<h2>Administreerimisleht</h2>
<?php if(isAdmin()) { ?>
<table>
    <tr>
        <th>Tantsupaari nimi</th>
        <th>Punktid</th>
        <th>Kuupäev</th>
        <th>Kommentaarid</th>
        <th>Avalik</th>
    </tr>


<?php
global $yhendus;
    $kask=$yhendus->prepare('SELECT id, tantsupaar, punktid, ava_paev, kommentaarid, avalik FROM tantsud');
    $kask->bind_result($id,$tantsupaar,$punktid, $ava_paev, $kommentaarid, $avalik);
    $kask->execute();
    while($kask-> fetch()){
        $tekst="Näita";
        $seisund="naitmine";
        $tekst2="kasutaja ei näe";
        if($avalik==1){
            $tekst="Peida";
            $seisund="peitmine";
            $tekst2 = "kasutaja näitab";
        }

        echo "<tr>";
        $tantsupaar=htmlspecialchars($tantsupaar);
        echo "<td>".$tantsupaar."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".$ava_paev."</td>";
        echo "<td>".$kommentaarid."</td>";
        echo "<td>".$avalik."/".$tekst2."</td>";
        echo "<td><a href='?punktid0=$id' >punktid nulliks</a></td>";
        echo "<td><a href='?$seisund=$id'>$tekst</a></td>";
        echo "</tr>";
    }
?>
</table>
<?php } ?>
</body>
</html>