<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class testRequest extends TestCase
{

    public function testReqProtocol(): void
    {
        $request = file_get_contents("http://localhost:8000/protocol");
      
        $this->assertSame('HTTP/1.1', trim($request));

    }

    public function testReqHostname(): void
    {
        $request = file_get_contents("http://localhost:8000/test/hostname");
      
        $this->assertSame('localhost:8000', trim($request));

    }

    public function testReqMethod(): void
    {
        $request = file_get_contents("http://localhost:8000/method");
      
        $this->assertSame('GET', trim($request));

    }


    public function testReqBody(): void
    {
        $request = file_get_contents("http://localhost:8000/body?id=1&test=true");
      
        $this->assertSame('{"id":"1","test":"true"}', trim($request));

    }

    public function testReqIp(): void
    {
        $request = file_get_contents("http://localhost:8000/ip");
      
        $this->assertSame('127.0.0.1', trim($request));

    }


    public function testReqPath(): void
    {
        $request = file_get_contents("http://localhost:8000/path");
      
        $this->assertSame('/path', trim($request));

    }
    public function testReqSecure(): void
    {
        $request = file_get_contents("http://localhost:8000/secure");
      
        $this->assertSame('null', trim($request));

    }
    public function testReqParams(): void
    {
        $request = file_get_contents("http://localhost:8000/test/1");
      
        $this->assertSame('{"id":"1"}', trim($request));

    }

}

?>