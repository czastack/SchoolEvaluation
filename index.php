<?php 
$url = "web/index.php";
$get = $_SERVER["QUERY_STRING"];
if($get)
	$url .= '?' . $get;
header("Location: $url");
?>