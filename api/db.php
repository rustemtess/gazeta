<?php

$host = 'localhost';
$login = 'root';
$password = '';
$dbName = 'gazeta';
$db = mysqli_connect($host, $login, $password, $dbName);

if(!$db) {
    die('Error');
}

?>