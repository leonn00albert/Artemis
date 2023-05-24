<?php declare(strict_types=1);
require_once "vendor/autoload.php";
use Artemis\Core\DataBases\CSV\DBCSV;

use PHPUnit\Framework\TestCase;
$id;

final class testDBCSV extends TestCase
{


    public function testCreate(): void
    {
        global $id;
        unlink("test.csv");
        $db =  DBCSV::getInstance("test");
        $id =  time();
        $header = $db->create(["testheader", "testheader2"]);
        $result = $db->create([ "test" . $id,  "test" . $id * 2]);
        $this->assertSame("testheader", $header[0]);
        $this->assertSame("test" . $id, $result[0]);
 
    }


    public function testFind(): void
    {    
        global $id;
        $db = DBCSV::getInstance("test");
        $result = $db->find([]);

        $this->assertSame("test" . $id, $result[0]["testheader"]);
 
    }



}
