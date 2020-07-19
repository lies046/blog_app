<?php
$dns='mysql:host=localhost;dbname=blog_app;charset=utf8;';
$user = 'root';
$pass = '';

try{
$dbh= new PDO($dns, $user, $pass,[
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
echo '接続成功';
$dbh = null;
}catch(PDOException $e){
  echo '接続失敗'.$e->getMessage();
  exit();
};