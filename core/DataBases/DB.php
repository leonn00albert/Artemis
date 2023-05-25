<?php

namespace Artemis\Core\DataBases;

use Artemis\Core\DataBases\JSON\DBJSON;
use Artemis\Core\DataBases\CSV\DBCSV;
use Artemis\Core\DataBases\Interface\Database;
use Artemis\Core\DataBases\SQlite\SQLite;
use Exception;


class DB
{
    public static function new(string $type, string $name ,string $pass=""): Database
    {
        switch ($type) {
            case 'JSON':
                return  DBJSON::getInstance($name,$pass);
            case 'CSV':
                return  DBCSV::getInstance($name);
            case 'SQLite':
                return  SQLite::getInstance($name);
            default:
                throw new Exception("Invalid db type: " . $type);
        }
    }
}
