<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class testRequest extends TestCase
{

    public function testReqProtocol(): void
    {
        $request = file_get_contents("http://localhost:8000/protocol");
      
        $this->assertSame("HTTP/1.1", trim($request));

    }

    public function testReqHostname(): void
    {
        $request = file_get_contents("http://localhost:8000/test/hostname");
      
        $this->assertSame("localhost:8000", trim($request));

    }

    public function testReqMethod(): void
    {
        $request = file_get_contents("http://localhost:8000/method");
      
        $this->assertSame("GET", trim($request));

    }


    public function testReqBody(): void
    {
        $curl = curl_init();

        $url = "http://localhost:8000/body";
        $data = array(
            'id' => '1',
            'test' => 'true'
        );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if(curl_errno($curl)){
            $error = curl_error($curl);
    
        }

        curl_close($curl);

        // Process the response
        $this->assertSame("{\"id\":\"1\",\"test\":\"true\"}", trim($response));

    }

    public function testReqIp(): void
    {
        $request = file_get_contents("http://localhost:8000/ip");
      
        $this->assertSame("::1", trim($request));

    }


    public function testReqPath(): void
    {
        $request = file_get_contents("http://localhost:8000/path");
      
        $this->assertSame("/path", trim($request));

    }
    public function testReqSecure(): void
    {
        $request = file_get_contents("http://localhost:8000/secure");
      
        $this->assertSame("", trim($request));

    }
    public function testReqParams(): void
    {
        $request = file_get_contents("http://localhost:8000/test/1");
      
        $this->assertSame("{\"id\":\"1\"}", trim($request));

    }

}
