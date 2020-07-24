<?php

include('config.php');

$DBHOST= 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'dbaulads';

$conexao = new PDO("mysql:host=" . $DBHOST . "; dbname=" . $DBNAME, $DBUSER, $DBPASSWORD);
