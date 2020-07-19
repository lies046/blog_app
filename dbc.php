<?php
$dns='mysql:host=localhost;dbname=blog_app;charset=utf8;';
$user = 'root';
$pass = '';
$dbh= new PDO($dns, $user, $pass);

var_dump($dbh);