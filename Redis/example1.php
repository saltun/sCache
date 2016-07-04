<?php
/**
* @author Savaş Can Altun <savascanaltun@gmail.com>
* sCache Sınıfı redis versiyonu
*/ 


require_once "predis/autoload.php";

require_once "sCache.php";



$options = array(
	'time'   => 20,
	'dir'    => 'sCache',
	'buffer' => true,
	'load'   => true,
	'extension' => '.scache' 
	);


/**
* Predis ile redis bağlantısı
* @see https://github.com/nrk/predis
*/
$redis=array("scheme" => "tcp","host" => "127.0.0.1","port" => 6379);

$sCache = new sCache($redis,$options);





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
