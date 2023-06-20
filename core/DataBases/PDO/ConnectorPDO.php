<?php

namespace Artemis\Core\DataBases\PDO;


use Artemis\Core\DataBases\Abstract\AbstractDB;
use Artemis\Core\DataBases\Interface\Database;
use PDO;
use PDOException;
//make singleton 

// add encryption

// add login and auth 

/**
 * A JSON based DB using Mongoose style syntax
 */

class ConnectorPDO extends AbstractDB implements Database
{

    private PDO| null $connection;
    private static  $instances = [];
    private string $db_host;
    private string $db_user;
    private string $db_password;
    private string $db_name;
    private string $table;

    protected function __construct(string $driver,string $db_host, string $db_user, string $db_password, string $db_name)
    {
        $this->connection = $this->createPDO($driver,$db_host,$db_user,$db_password,$db_name);
        $this->db_user = $db_user;
        $this->db_host = $db_host;
        $this->db_password = $db_password;
        $this->db_name = $db_name;
    }
    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public static function getInstance(string $driver,string $db_host, string $db_user, string $db_password, string $db_name): Database
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($driver,$db_host, $db_user, $db_password, $db_name);
        }

        return self::$instances[$cls];
    }

    /**
     * @param string $sql
     * 
     * @return bool
     */
    public function create(array $query)
    {
        try {
            $this->connection->exec($query["sql"]);
          
            return $this;
        } catch (PDOException $e) {
            echo $query["sql"] . "<br>" . $e->getMessage();
            return false;
        }
    }
    public function find(array $query):array
    {
        $arr = [];
        try {
            $stmt = $this->connection->prepare($query["sql"]);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $k => $v) {
                $arr[] = $v;
            }
            return $arr;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function findById(string $query)
    {
        
    }

 

    public function updateById(string $id, array $update): array{
        return [];
    }

    /**
     * @param string $sql
     * 
     * @return array
     */


    public function selectTable(string $table) :void
    {
        $this->table = $table;

    }
    public function conn(): PDO
    {
        return $this->connection;
    }

    /**
     * @param mixed $sql
     * 
     * @return bool
     */
    public function update($sql): bool
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }

    /**
     * @return array
     */
    public function selectAll(): array
    {
        return $this->find(["sql" => "SELECT * FROM $this->table"]);
    }


    /**
     * @param string $table
     * @param string $id
     * 
     * @return bool or Database
     */
    public function deleteById( string $id): bool|Database
    {
        try {

            $sql = "DELETE FROM $this->table WHERE id=$id";
            $this->connection->exec($sql);
            return $this;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }


    /**
     * @param string $tableName
     * @param string $sql
     * 
     * @return bool or Database
     */
    public function createTable(array $arr): bool|Database
    {
        // Check if the table exists
        $query = "SHOW TABLES LIKE '" . $arr["table_name"] . "'";
        $stmt = $this->connection->query($query);
        $tableExists = ($stmt->fetchColumn() > 0);
        $this->table = $arr["table_name"];
        if (!$tableExists) {
            $this->connection->exec($arr["sql"]);
            return $this;
        } else {
            return false;
        }
    }
    /**
     * @param mixed $table
     * 
     * @return int
     */
    public function count() :int
    {
        $sql = "SELECT COUNT(*) as total FROM $this->table";
        $stmt = $this->connection->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];

    }

    /**
     * @return bool
     */
    public function drop(): bool
    {
        try {
            $sql = "DROP TABLE $this->table";
            $this->connection->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    /**
     * @return bool
     */
    public function clear(): bool
    {
        try {
            $sql = "TRUNCATE TABLE $this->table";
            $this->connection->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
            return false;
        }
    }

    /**
     * @return void
     */
    public function close(): void
    {
        $this->connection = null;
    }


    /**
     * @param string|null $db_host
     * @param string|null $db_user
     * @param string|null $db_password
     * @param string|null $db_name
     * 
     * @return Database
     */
    private function createPDO($driver, $host, $username, $password, $database) {
            $dsn = "$driver:host=$host;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);
        
            $sql = "CREATE DATABASE IF NOT EXISTS $database";
            $pdo->exec($sql);
            $dsn = "$driver:host=$host;dbname=$database;charset=utf8mb4";
      
        try {
            $pdo = new PDO($dsn, $username, $password);
            
            // Set PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // Additional PDO configurations if needed
            // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $pdo;
        } catch (PDOException $e) {
            // Handle any errors that occur during PDO connection
            die('PDO Connection failed: ' . $e->getMessage());
        }
    }
    public function connect(string $db_host = null, string $db_user = null, string $db_password = null, string $db_name = null): Database
    {
        if ($db_host === null || $db_user === null || $db_password === null || $db_name === null) {
            $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            return $this;
        } else {
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            return $this;
        }
    }

}
