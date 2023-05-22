<?php declare(strict_types=1);
require_once "vendor/autoload.php";
use Artemis\Core\DataBases\JSON\DBJSON;

use PHPUnit\Framework\TestCase;
$id;

final class testDBJSON extends TestCase
{


    public function testCreate(): void
    {
        global $id;
        unlink("test/.json");
        rmdir("test");
        $db = new DBJSON("test");
        $id =  time();
        $result = $db->create(["test" => "test" . $id]);
        $this->assertSame("test" . $id, $result[0]["test"]);
 
    }


    public function testFind(): void
    {    
        global $id;
        $db = new DBJSON("test");
   
        $result = $db->find([]);
        $result[0] = (array) $result[0];
        $this->assertSame("test" . $id, $result[0]["test"]);
 
    }

    public function testFindByQuery(): void
    {    
        global $id;
        $db = new DBJSON("test");
        $result = $db->find(["test" => "test" . $id ]);
        $result[0] = (array) $result[0];
        $this->assertSame("test" . $id, $result[0]["test"]);
 
    }


}
