<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class testSecure extends TestCase
{

    public function testSecureLocal(): void
    {
        $curl = curl_init();

        $url = "http://localhost:8000/secure/local";
        $data = array(
            'user' => 'leon',
            'password' => '12345'
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
        $this->assertSame("leon", trim($response));

    }


}

?>