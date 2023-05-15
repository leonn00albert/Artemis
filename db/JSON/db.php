<?php
require_once('render_table.php');

class Database {
   public string $db_name = "";
   public string $db_path = "";
   function __construct(string $name) {
        $this->db_name = $name;
        if (!is_dir($name)) {
            mkdir($name);
            $this->db_path = "./" . $name;
    
        }    
   }

   function table(string $name):array{
        $table = fopen($this->db_path . '/' .$name . '.csv', 'r');
        if($table == False) {
            return False;
        }
        $data = array();

        while (($row = fgetcsv($table)) !== false) {
        $data[] = $row;
        }
        fclose($table);
        return $data;
    }
   function create_table(string $name, array $columns):bool{
        $table = fopen($this->db_path . '/' .$name . '.csv', 'w');
        if($table == False) {
            return False;
        }
        fputcsv($table, $columns);
        return True;
    }

    function update_row(string $name, int $id ,array $row_data):bool{
        $table = fopen($this->db_path . '/' .$name . '.csv', 'r+');
        if($table == False) {
            return False;
        }
        $headers = [];
        $row = 0; 
        while (($data = fgetcsv($table)) !== false) {
            if ($row == 0) {
                $headers = $data;
            }
            $new_arr = [];
            if ($row == $id) {
                foreach($headers as $i => $header) {
                    $new_arr[$header] = $data[$i];
                
                }
                $data = $new_arr;
                $data = array_replace($data, $row_data);
                fseek($table, -strlen(implode(",", $data)), SEEK_CUR);
       

                fputcsv($table, $data);

                break;
            }
            $row++;
        }
        
        fclose($table);
        return True;
    }

    function create_row(string $table_name, array $data):bool{
        $table = fopen($this->db_path . '/' . $table_name . '.json', 'a');
        if($table == False) {
            return False;
        }
        foreach ($data as $row) {
            fputcsv($table, $row);
        }
        return True;
        
    }
}

$db = new Database("test");
$db->create_table("test", ["first_name","last_name","email"]);
$db->create_row("test",[
    ['first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john.doe@example.com'],
    ['first_name' => 'Jane', 'last_name' => 'Smith', 'email' => 'jane.smith@example.com'],
    ['first_name' => 'Bob', 'last_name' => 'Johnson', 'email' => 'bob.johnson@example.com']
]);

$db->update_row("test", 1,
    ['first_name' => 'Bob', 'last_name' => 'Johnson']
);

render_table($db->table("test"));