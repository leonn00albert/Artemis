<?php

namespace Artemis\Core\DataBases\JSON;


use Artemis\Core\DataBases\Abstract\AbstractDB;
use Artemis\Core\DataBases\Interface\Database;

//make singleton 

// add encryption

// add login and auth 

/**
 * A JSON based DB using Mongoose style syntax
 */

class DBJSON extends AbstractDB implements Database
{
    static  $instance;
    public string $db_name = "";
    public string $db_path = "";
    public $data = [];

    protected function __construct($name)
    {
        $this->db_name = $name;
        if (!is_dir($name)) {
            mkdir($name);
        }
        $this->db_path = "./" . $name;
        if (is_file($name . "/" . ".json")) {
            $this->data = $this->openFileDecodeJson($this->db_name . "/" . ".json");
        }
    }

    public static function getInstance($name)
    {
        if (!self::$instance) {
            self::$instance = new DBJSON($name);
        }
        return self::$instance;
    }



    /**
     * @param array $query
     *
     * @return [type]
     */
    function find(array $query): array
    {
        if ($query === []) {

            return $this->data;
        } else {
            
            $result = $this->findByQuery($this->data, $query);
            return $result;
        }
    }

    /**
     * @param array $query
     *
     * @return stdClass
     */
    function findOne(array $query)
    {
        if ($query === []) {
            return [];
        } else {
            $result = $this->findByQuery($this->data, $query);
            return $result[0];
        }
    }

    /**
     * @param array $query
     *
     * @return array
     */
    function deleteMany(array $query)
    {
        if ($query === []) {
            if (file_exists($this->db_path . "/" . ".json")) {
                unlink($this->db_path . "/" . ".json");
                return [];
            }
        }
    }
    /**
     * @param array $arr
     *
     * @return array
     */
    function create(array $arr): array
    {
        array_push($this->data, ["id" => uniqid(), ...$arr]);
        $key = 'YourEncryptionKey';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedText = openssl_encrypt(json_encode($this->data), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $fileSignature = hash('sha256', $encryptedText);
        $encryptedTextWithIV = $iv . $encryptedText;

        $file = fopen($this->db_path . "/" . ".json", "w");
        if (!$file) {
            return false;
        }


        $json_data = crypt(json_encode($encryptedTextWithIV),"test");
        fwrite($file, $json_data);
        fclose($file);
        return $this->data;
    }

    /**
     * @param string $id
     * 
     * @return [type]
     */
    function findById(string $id)
    {
        if (!$id) {
            return [];
        } else {
            $result = $this->findByQuery($this->data, ["id" => $id]);
            return $result;
        }
    }

    /**
     * @param string $id
     * @param array $update
     * 
     * @return array
     */
    function updateById(string $id, array $update): array
    {
        if ($id === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . "/" . ".json", "w");
            fwrite($file, json_encode($this->updateByQuery($this->data, ["id" => $id], $update)));
            fclose($file);
            return $this->updateByQuery($this->data, ["id" => $id], $update);
        }
    }

    /**
     * @param string $id
     * 
     * @return [type]
     */
    function deleteById(string $id)
    {
        if ($id === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . "/" . ".json", "w");
            fwrite($file, json_encode($this->deleteByQuery($this->data, ["id" => $id])));
            fclose($file);
            return $this->deleteByQuery($this->data, ["id" => $id]);
        }
    }

    /**
     * @param array $query
     * @param array $update
     * 
     * @return [type]
     */
    function updateMany(array $query, array $update)
    {
        if ($query === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . "/" . ".json", "w");
            fwrite($file, json_encode($this->updateByQuery($this->data, $query, $update)));
            fclose($file);
            return $this;
        }
    }

    /**
     * @param array $data
     * @param array $query
     * 
     * @return array
     */
    private function findByQuery(array $data, array $query): array
    {
        $arr = [];
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                foreach ($query as $query_key => $query_value) {
                    if ($key == $query_key && $value ==  $query_value) {
                        array_push($arr, $data[$i]);
                    }
                }
            }
        }
        return $arr;
    }
    /**
     * @param array $data
     * @param array $query
     * 
     * @return array
     */
    private function deleteByQuery(array $data, array $query): array
    {
        $arr = $data;
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                foreach ($query as $query_key => $query_value) {
                    if ($key == $query_key && $value ==  $query_value) {
                        unset($arr[$i]);
                    }
                }
            }
        }

        return array_values($arr);
    }

    /**
     * @param array $data
     * @param array $query
     * @param array $update
     * 
     * @return array
     */
    private function updateByQuery(array $data, array $query, array $update): array
    {
        $arr = $data;
        for ($i = 0; $i < count($data); $i++) {
            foreach ((array) $data[$i] as $key => $value) {
                foreach ($query as $query_key => $query_value) {
                    if ($key == $query_key && $value ==  $query_value) {
                        $arr[$i] = array_replace((array)$arr[$i], $update);
                    }
                }
            }
        }
        return $arr;
    }
    /**
     * @param string $file_path
     * 
     * @return array
     */
    private function openFileDecodeJson(string $file_path): array | null
    {
        $key = 'YourEncryptionKey';
        $encryptedTextWithIV = file_get_contents($file_path);

        if ($encryptedTextWithIV === false) {
        }
    
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($encryptedTextWithIV, 0, $ivLength);
        $encryptedText = substr($encryptedTextWithIV, $ivLength);
        
        $decryptedText = openssl_decrypt($encryptedText, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        
        $decoded_data = json_decode($decryptedText);
        if ($decoded_data === null) {
            $json_error = json_last_error_msg();

            print  $json_error;
        }

        return (array) $decoded_data;
    }
}
