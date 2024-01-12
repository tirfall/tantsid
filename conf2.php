<?php
$kasutaja='d123185_aleksrog';
$serverinimi='d123185.mysql.zonevs.eu';
$parool='45123321Veroni';
$andmebaas='d123185_andmebaas';
$yhendus=new mysqli($serverinimi,$kasutaja,$parool,$andmebaas);
$yhendus->set_charset('UTF8');
?>
