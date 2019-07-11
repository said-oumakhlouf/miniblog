<?php

// Config serveur
$host ='db5000093912.hosting-data.io';
$dbname ='dbs88517';
$user='dbu83591';
$charset='utf8';
$password='xxxxxxxx';
$_ENV["DB"] = new PDO("mysql:host=$host;charset=$charset;dbname=$dbname", $user, $password);