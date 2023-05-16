<?php

namespace db\JSON;
require_once('render_table.php');
require_once('functions.php');

interface JSON_DB
{
    public function create(array $arr);

    public function find(array $query);
}

/**
 * A JSON based DB using Mongoose style syntax
 */
class Polecat implements JSON_DB
{
    public string $db_name = "";
    public string $db_path = "";
    public $data = [];

    function __construct(string $name)
    {
        $this->db_name = $name;
        if (!is_dir($name)) {
            mkdir($name);
        }
        $this->db_path = "./" . $name;
        if (is_file($name . '/' . '.json')) {
            $this->data = open_file_decode_json($this->db_name . '/' . '.json');
        }
    }

    private function update()
    {
        $this->data = open_file_decode_json($this->db_name . '/' . '.json');
        return $this;
    }

    /**
     * @param array $query
     *
     * @return [type]
     */
    function find(array $query)
    {
        if ($query === []) {

            return $this->data;
        } else {
            $result = find_by_query($this->data, $query);
            return $result;
        }
    }

    /**
     * @param array $query
     *
     * @return stdClass
     */
    function findOne(array $query): stdClass
    {
        if ($query === []) {
            return [];
        } else {
            $result = find_by_query($this->data, $query);
            return $result[0];
        }
    }

    /**
     * @param array $query
     *
     * @return array
     */
    function deleteMany(array $query): array
    {
        if ($query === []) {
            if (file_exists($this->db_path . '/' . '.json')) {
                unlink($this->db_path . '/' . '.json');
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
        $this->data = array_merge((array)$this->data, array_map(function ($x) {
            return ["id" => uniqid(), ...$x];
        }, $arr));

        $file = fopen($this->db_path . '/' . '.json', 'w');
        if (!$file) {
            return false;
        }

        $json_data = json_encode($this->data);
        fwrite($file, $json_data);

        fclose($file);
        return $this->data;
    }

    function findById(string $id)
    {
        if (!$id) {
            return [];
        } else {
            $result = find_by_query($this->data, ["id" => $id]);
            return $result;
        }
    }

    function updateById(string $id, array $update): array
    {
        if ($id === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . '/' . '.json', 'w');
            fwrite($file, json_encode(update_by_query($this->data, ["id" => $id], $update)));
            fclose($file);
            return update_by_query($this->data, ["id" => $id], $update);
        }
    }

    function deleteById(string $id)
    {
        if ($id === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . '/' . '.json', 'w');
            fwrite($file, json_encode(delete_by_query($this->data, ["id" => $id])));
            fclose($file);
            return delete_by_query($this->data, ["id" => $id]);
        }
    }

    function updateMany(array $query, array $update)
    {
        if ($query === []) {
            return $this;
        } else {
            $file = fopen($this->db_path . '/' . '.json', 'w');
            fwrite($file, json_encode(update_by_query($this->data, $query, $update)));
            fclose($file);
            return $this;
        }
    }
}
