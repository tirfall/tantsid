<?php
$kasutaja = 'tarpv22';
$serverinimi = 'localhost';
$parool = '';
$andmebaas = 'tantsu';
$yhendus = new mysqli($serverinimi, $kasutaja, $parool, $andmebaas);
$yhendus->set_charset('UTF8');
?>
