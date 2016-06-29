<?php
/*
* Clear all cache files
*/
require_once "../sCache.php";

$sCache = new sCache("",false); // cache system close and all cache files clear
$sCache->clearCache();
