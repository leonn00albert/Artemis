<?php

namespace Artemis\Core\DataBases\CSV;

use Artemis\Core\DataBases\Abstract\AbstractDB;
use Artemis\Core\DataBases\Interface\Database;


class DBCSV extends AbstractDB implements Database
{
    static  $instance;
    private $fileHandle;
    private string $filePath = "";

    protected function __construct($filename)
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
        fputcsv($this->fileHandle, array_values($data));
        return $data;
    }


    function find(array $query): array
    {
        $tmp = [];
        $headers = [];
        $file = fopen($this->filePath, 'r');
        if ($file) {

            while (($row = fgetcsv($file)) !== false) {
                $tmp[] = $row;
            }
            fclose($file);


            if (count($tmp) > 0) {
                $headers = $tmp[0];
                unset($tmp[0]);
            }

            $result = [];
            foreach ($tmp as $row) {

                $result[] = array_combine($headers, array_values($row));
            }

            return $result;
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
        return [];
    }
    public function deleteMany()
    {
        unlink("database.csv");
    }

    public function closeDatabase()
    {
        fclose($this->fileHandle);
    }
}
