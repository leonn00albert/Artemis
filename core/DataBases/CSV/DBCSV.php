<?php
namespace Artemis\Core\DataBases\CSV;
use Exception;
use Artemis\Core\DataBases\Database;

class DBCSV implements Database
{
    private static $instance;
    private $fileHandle;
    private string $filePath = "";

    private function __construct($filename)
    {
        $this->fileHandle = fopen($filename . ".csv", "a+");
        $this->filePath = $filename . ".csv";
    }

    public static function getInstance($filename)
    {
        if (!self::$instance) {
            self::$instance = new DBCSV($filename);
        }
        return self::$instance;
    }

    public function create($data)
    {   
        $list = [];
        foreach($data as $key => $value){
            array_push($list,[$key, $value]);
        }
        foreach ($list as $line) {
            fputcsv($this->fileHandle, $line);
          }
       
    }

    function find(array $query):array
    {
        $tmp = [];
        $headers = [];
        $file = fopen("database.csv", 'r'); 
        if ($file) {
            if($query = []) {
                while (($row = fgetcsv($file)) !== false) {
                    $tmp[] = $row; 
                }
        
            }
            fclose($file);
            for ($i = 0; $i < count($tmp); $i++){
                if($i === 0 ){

                }else {
                    array_push($tmp, array_combine($headers,$row));
                }
             
            }
        
        }
        return $tmp;
    }


    public function findById(string $query) 
    {

    }
    public function deleteById(string $id)
    {

    }
    public function updateById(string $id, array $update): array
    {

    }
    public function deleteMany(){
        unlink("database.csv");
    }

    public function closeDatabase()
    {
        fclose($this->fileHandle);
    }
}