<?php

namespace Artemis\Core\DataBases;

use Artemis\Core\DataBases\JSON\DBJSON;
use Artemis\Core\DataBases\CSV\DBCSV;
use Artemis\Core\DataBases\Interface\Database;
use Artemis\Core\DataBases\SQlite\SQLite;
use Artemis\Core\DataBases\PDO\ConnectorPDO;
use Exception;


class DB
{
    public static function new(string $type, string $name ,string $pass="", $driver=null, $db_host=null, $db_user=null): Database
    {
        switch ($type) {
            case 'JSON':
                return  DBJSON::getInstance($name,$pass);
            case 'CSV':
                return  DBCSV::getInstance($name);
            case 'SQLite':
                return  SQLite::getInstance($name);
            case 'PDO':
                    return  ConnectorPDO::getInstance($driver,$db_host, $db_user, $pass, $name);
            default:
                throw new Exception("Invalid db type: " . $type);
        }
    }
}
