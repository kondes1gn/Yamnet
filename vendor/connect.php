<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'bd_project');

if (!$connect) {
    die('Error connect to DataBase');
}