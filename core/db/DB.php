<?php

namespace db;
use Polecat;

include "Artemis\db\JSON\db_json.php";

/// make singleton
// make factory
class db
{
    public $con;

    function __construct($db_type, $name)
    {
        $this->con = match ($db_type) {
            "JSON" => new Polecat($name)
        };
    }
}
