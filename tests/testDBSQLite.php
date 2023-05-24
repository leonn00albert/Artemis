<?php declare(strict_types=1);
require_once "vendor/autoload.php";
use Artemis\Core\DataBases\DB;
use PHPUnit\Framework\TestCase;

$id;

final class testDBSQLite extends TestCase
{


    public function testCreate(): void
    {
        global $id;
        unlink("test.db");
        $db =  DB::new("SQLite","test");
        $id =  time();
        $header = $db->create(["testheader", "testheader2"]);
        $result = $db->create([ "test" . $id,  "test" . $id * 2]);
        $this->assertSame("testheader", $header[0]);
        $this->assertSame("test" . $id, $result[0]);
 
    }

}
