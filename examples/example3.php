<?php 
require_once('../sCache.php');

$options = array(
	'time'   => 20,
	'dir'    => 'sCache',
	'buffer' => true,
	'load'   => true,
	'extension' => '.scache' 
	);



$sCache = new sCache($options,false); // Cache dont work





sleep(2);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sCache Example Page</title>
</head>
<body>
	<h1>Page load no cache 2 seconds</h1>
</body>
</html>
