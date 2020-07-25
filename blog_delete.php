<?php

require_once('blog.php');

$blog = new blog();
$result=$blog->delete($_GET['id']);

?>

<p><a href="/">戻る</a></p>