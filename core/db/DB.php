<?php

namespace Artemis\Core;


use Artemis\Core\DataBases;

/// make singleton
// make factory
class DB
{
    public $con;

    function __construct($db_type, $name)
    {
        $this->con = match ($db_type) {
            "JSON" => new DataBases\DBJSON($name)
        };
    }
}
