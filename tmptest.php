<?php

declare(strict_types=1);
require_once "vendor/autoload.php";

use Artemis\Core\DataBases\CSV\DBCSV;


$db = DBCSV::getInstance("test");
$result = $db->create(["testheader" => "testheader" . $id]);
$result = $db->create(["test" => "test" . $id]);
$result = $db->find([]);
$result[0] = (array) $result[0];
print_r($result);