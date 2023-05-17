<?php

namespace Artemis\Core;


use Artemis\Core\DataBases\DBJSON;

/// make singleton
// make factory
class DB
{
    public $con;

    function __construct($db_type, $name)
    {
        $this->con = match ($db_type) {
            "JSON" => new DBJSON($name)
        };
    }
}
