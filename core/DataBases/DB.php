<?php

namespace Artemis\Core\DataBases;

use Artemis\Core\DataBases\JSON\DBJSON;

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
