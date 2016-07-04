<?php
/*
* Clear all cache files
*/
require_once "predis/autoload.php";
require_once "sCache.php";

$redis=array("scheme" => "tcp","host" => "127.0.0.1","port" => 6379);

$sCache = new sCache($redis,"",false); // Clear redis all keys
$sCache->clearCache();
