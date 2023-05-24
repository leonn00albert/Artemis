<?php 
namespace Artemis\Core\DataBases\Abstract;
use Artemis\Core\DataBases\Interface\Database;

abstract class AbstractDB {
    abstract protected function __construct(string $name);

}
