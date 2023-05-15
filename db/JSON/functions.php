<?php



function find_by_query(array $data, array $query):array {
    $arr = [];
    for ($i = 0; $i < count($data); $i++) {
        foreach ($data[$i] as $key => $value) {
            foreach ($query as $query_key => $query_value) {
            if($key == $query_key && $value ==  $query_value){
                array_push($arr, $data[$i]);
            }
        }
        
    }
    }
    return $arr;

}
function delete_by_query(array $data, array $query):array | stdClass {
    $arr = $data;
    for ($i = 0; $i < count($data); $i++) {
        foreach ($data[$i] as $key => $value) {
            foreach ($query as $query_key => $query_value) {
            if($key == $query_key && $value ==  $query_value){
                unset($arr[$i]);
            } 
         }
        
        }
    }

    return array_values($arr);

}

function update_by_query(array $data, array $query, array $update):array | stdClass {
    $arr = $data;
    for ($i = 0; $i < count($data); $i++) {
        foreach ((array) $data[$i] as $key => $value) {
            foreach ($query as $query_key => $query_value) {
            if($key == $query_key && $value ==  $query_value){
                $arr[$i] = array_replace((array)$arr[$i], $update);
         
            } 
         }
        
        }
    }
    return $arr;

}

function open_file_decode_json(string $file_path): array | stdClass | null {
    $data = file_get_contents($file_path);

    if ($data === false) {
  
    }
    
    $decoded_data = json_decode($data);
    if ($decoded_data === null) {
        $json_error = json_last_error_msg();
     
        print  $json_error;
    }
    
    return $decoded_data;
}