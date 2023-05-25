<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class testResponse extends TestCase
{

    public function testResSend(): void
    {
        $request = file_get_contents("http://localhost:8000/send");
      
        $this->assertSame('test', trim($request));

    }

    public function testResJson(): void
    {
        $request = file_get_contents("http://localhost:8000/json");
      
        $this->assertSame('{"test":true}', trim($request));

    }


   

}

?>