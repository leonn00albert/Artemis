<?php

declare(strict_types=1);
require_once "vendor/autoload.php";



use Artemis\Core\DataBases\DB;
$id = time();
$db = DB::new("CSV", "test");
$header = $db->create(["testheader", "testheader2"]);
$result = $db->create([ "test" . $id,  "test" . $id * 2]);
$result = $db->find([]);
$result[0] = (array) $result[0];
print_r($result);