<?php

namespace Artemis\Core\DataBases;

use Artemis\Core\DataBases\JSON\DBJSON;
use Artemis\Core\DataBases\CSV\DBCSV;
use Artemis\Core\DataBases\Interface\Database;

use Exception;


class DB
{
    public static function new(string $type, string $name): Database
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
