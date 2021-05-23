<?php
require_once 'dbconfig.php';


$connect = mysqli_connect($servername, $dblogin, $dbpass, $dbname);


if (!$connect) {
    die('Error connect to DataBase');
}