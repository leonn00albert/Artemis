<?php

namespace Artemis\Core\DataBases;

use Artemis\Core\DataBases\JSON\DBJSON;
use Artemis\Core\DataBases\CSV\DBCSV;
use Exception;
/// make singleton
// make factory


class DataBaseFactory
{
    public $con;
    public static function createVehicle(string $type, string $name): Database
    {
        switch ($type) {
            case 'JSON':
                return  DBJSON::getInstance($name);
            case 'CSV':
                return  DBCSV::getInstance($name);
            default:
                throw new Exception("Invalid db type: " . $type);
        }
    }
}
