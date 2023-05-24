<?php
namespace Artemis\Core\DataBases;

interface Database
{  
    public function create(array $arr);
    public function find(array $query):array;
    public function findById(string $query);
    public function deleteById(string $id);
    public function updateById(string $id, array $update): array;

}

abstract class DB {
     abstract function __construct(string $name);

}

?>