<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;


final class testArtemis extends TestCase
{

    public function testAppGet(): void
    {
        $url = 'http://localhost:8000/get' ;
        $options = array(
        'method' => 'GET',
        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);

      
        $this->assertSame("200", trim($response));

    }

    public function testAppPost(): void
    {
        $form_data = array("test" => "true");
        $url = 'http://localhost:8000/post';
        $options = array(
        'method' => 'POST',
        'header' => 'Content-Type: application/json',
        'content' => json_encode($form_data)

        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);

      
        $this->assertSame("true", trim($response));
        
    }
    public function testAppPut(): void
    {
        $form_data = array("test" => "true");
        $url = 'http://localhost:8000/put';
        $options = array(
        'method' => 'PUT',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($form_data)

        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);

      
        $this->assertSame("updated", trim($response));
        
    }
    public function testAppDelete(): void
    {
        $form_data = array("test" => "true");
        $url = 'http://localhost:8000/delete';
        $options = array(
        'method' => 'DELETE',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($form_data)

        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);

      
        $this->assertSame("delete", trim($response));
        
    }

    public function testForParam(): void
    {

        $url = 'http://localhost:8000/params/1232' ;
        $options = array(
        'method' => 'GET',
        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);
           
        $this->assertSame("1232", trim($response));
        
    }
    public function testForRestRoute(): void
    {

        $url = 'http://localhost:8000/params/123asdas2/test' ;
        $options = array(
        'method' => 'GET',
        );
        $context = stream_context_create(array('http' => $options));
        $response = file_get_contents($url, false, $context);
           
        $this->assertSame("123asdas2", trim($response));
        
    }


}

?>