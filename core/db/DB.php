<?php

namespace Artemis\Core\DB;

use Artemis\Core\DB\JSON\Polecat;

include "Artemis\db\JSON\db_json.php";

/// make singleton
// make factory
class DB
{
    public $con;

    function __construct($db_type, $name)
    {
        $this->con = match ($db_type) {
            "JSON" => new Polecat($name)
        };
    }
}
