<?php
namespace Artemis\Core\DataBases;

interface Database
{  
    public function __construct(string $name);
    public function create(array $arr);
    public function find(array $query):array;
    public function findById(string $query);
    public function deleteById(string $id);
    public function updateById(string $id, array $update): array;

}



?>