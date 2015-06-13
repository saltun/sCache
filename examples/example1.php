<?php 
require_once('sCache.php');

$options = array(
	'time'   => 20,
	'dir'    => 'sCache',
	'buffer' => true,
	'load'   => true 
	);

$sCache = new sCache($options);



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
