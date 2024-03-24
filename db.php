<?php
// $json_path = "config/credentials.json";

$string = __DIR__.'/vendor/autoload.php';

$newString = str_replace('public_html', '', $string);
require $newString;

use Kreait\Firebase\Factory;
$factory = (new Factory)
    -> withServiceAccount($json_path)
    -> withDatabaseUri('https://medsync-c1dbc-default-rtdb.asia-southeast1.firebasedatabase.app/');

$database = $factory->createDatabase();

?>