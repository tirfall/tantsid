<?php
require_once("conf.php");
session_start();

if(isset($_REQUEST["heatants"]) && !isAdmin()){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET punktid=punktid+1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST["heatants"]);
    $kask->execute();
}

if(isset($_REQUEST["badtants"]) && !isAdmin()){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET punktid=punktid-1 WHERE id=?");
    $kask->bind_param("i",$_REQUEST["badtants"]);
    $kask->execute();
}

if(isset($_REQUEST["paarinimi"]) && !empty($_REQUEST["paarinimi"]) && !isAdmin()){
    global $yhendus;
    $kask=$yhendus->prepare("INSERT INTO tantsud(tantsupaar, ava_paev) VALUES (?, NOW())");
    $kask->bind_param("s",$_REQUEST["paarinimi"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $yhendus->close();
    exit();
}

if(isset($_REQUEST["kustutamine"])){
    global $yhendus;
    $kask=$yhendus->prepare("DELETE FROM tantsud WHERE id=?");
    $kask->bind_param("i",$_REQUEST["kustutamine"]);
    $kask->execute();
}

if(isset($_REQUEST["komment"])) {
    if(!empty($_REQUEST["uuskomment"])) {
        global $yhendus;
        $kask=$yhendus->prepare("UPDATE tantsud SET kommentaarid=CONCAT(kommentaarid,?) WHERE id=?");
        $kommentplus=$_REQUEST["uuskomment"]. "\n";
        $kask->bind_param("si", $kommentplus, $_REQUEST["komment"]);
        $kask->execute();
        header("Location: $_SERVER[PHP_SELF]");
        $yhendus->close();
        //exit();
    }
}
$texttuhi = " ";
if(isset($_REQUEST["kustutamineKom"])){
    global $yhendus;
    $kask=$yhendus->prepare("UPDATE tantsud SET kommentaarid=?  WHERE id=?");
    $kask->bind_param("si", $texttuhi, $_REQUEST["kustutamineKom"]);
    $kask->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $yhendus->close();
}

function isAdmin(){
    return  isset ($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
}
function isKas(){
    return  isset ($_SESSION['onKas']) && $_SESSION['onKas'];
}
?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tantsud  tähtedega</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h1>Tantsud tähtedega</h1>
<header>
<?php
include('logimine.php');
include('registreerimine.php');
?>
</header>
<?php
include('navigatsioon.php');
?>
<h2>Kasutaja leht</h2>
<?php if(isKas()|| isAdmin()){ ?>
<table>
    <tr>
        <th>Tantsupaari nimi</th>
        <th>Punktid</th>
        <th>Ava päev</th>
        <th>Kommentaarid</th>
    </tr>


<?php
global $yhendus;
    $kask=$yhendus->prepare('SELECT id, tantsupaar, punktid, ava_paev, kommentaarid FROM tantsud WHERE avalik=1');
    $kask->bind_result($id,$tantsupaar,$punktid, $ava_paev, $komment);
    $kask->execute();
    while($kask-> fetch()){
        echo "<tr>";
        $tantsupaar=htmlspecialchars($tantsupaar);
        echo "<td>".$tantsupaar."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td>".$ava_paev."</td>";
        echo "<td>".nl2br(htmlspecialchars($komment))."</td>";
        if(!isAdmin()) {
            echo "<td>
            <form action='?'>
            <input type='hidden' value='$id' name='komment'>
            <input type='text' name='uuskomment' id='uuskomment'>
            <input type='submit' value='OK'>
            </form>";
        }
        //Kommentaar kustutamine
        if (isAdmin()){
            echo "<td><a href='?kustutamineKom=$id' >Kustuta kommentaarid</a></td>";
        }
        if (!isAdmin()) {
            echo "<td><a href='?heatants=$id' >Lisa +1 punkt</a></td>";
            echo "<td><a href='?badtants=$id' >Miinus -1 punkt</a></td>";
        }
        if (isAdmin()) {
            echo "<td><a href='?kustutamine=$id' >Kustuta</a></td>";
        }
        echo "</tr>";
    }
?>
    <?php if(!isAdmin()) { ?>

    <form action="?">
        <label for="paarinimi">Lisa uus paar </label>
        <input type="text" name="paarinimi" id="paarinimi">
        <input type="submit" value="Lisa paar">
    </form>
    <?php } ?>
</table>
<?php } ?>
</body>
</html>