<?php

namespace Artemis\Core\DataBases\SQlite;

use Artemis\Core\DataBases\Abstract\AbstractDB;
use Artemis\Core\DataBases\Interface\Database;
use SQLite3;


class SQLite extends AbstractDB implements Database
{
    static  $instance;
    private string $filePath = "";
    private SQLite3 $db;

    protected function __construct($filename)
    {
   
        $this->filePath = $filename . ".db";
        $this->db = new SQLite3($filename . ".db");

    }

    public static function getInstance($filename)
    {
        if (!self::$instance) {
            self::$instance = new SQLite($filename);
        }
        return self::$instance;
    }

    public function create($data)
    {   

        $query = "CREATE TABLE IF NOT EXISTS feeds (id INTEGER PRIMARY KEY, icon TEXT, rss TEXT, title TEXT)";
        $this->db->exec($query);

        $query = "INSERT INTO feeds (icon, rss, title) VALUES (:icon, :rss, :title)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute();
    
        if ($result) {
            return $data;
        } else {
            return $this->db->lastErrorMsg();
        }
        
       
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
        fclose($this->db->close());
    }
}
