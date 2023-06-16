<?php
namespace Artemis\Core\Forms;

use function PHPUnit\Framework\isEmpty;

/**
 * Handle form validation and sanatize inputs
 */
class Forms
{
    public $sanatize;
    public function __construct() {
        $this->sanatize = function ($req, $res) {
            if(count($req->body()) > 0) {
                foreach($req->body() as $key => $value) {
                    $req->sanatized[$key] = $this->checkInput($value);
                }
        
            }
        
        };
    }

   /**
    * @param mixed $data
    * 
    * @return [type]
    */
   private function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlentities($data);
        
        return htmlentities($data);
    }

    public function notEmpty($field) {
        return empty($field);
    }
    public function isEmpty($field) {
        return !empty($field);
    }
    public function  isNumeric($field) {
        return is_numeric($field);
    }


    public function validatePassword($password)
    {
        // Minimum length of 8 characters
        if (strlen($password) < 8) {
            return false;
        }

        // Must contain at least one uppercase letter, one lowercase letter, one digit, and one special character
        if (
            !preg_match('/[A-Z]/', $password) ||
            !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) ||
            !preg_match('/[^A-Za-z0-9]/', $password)
        ) {
            return false;
        }

        return true;
    }
    public function contains($field, $search): bool{
        if (strpos($field, $search) !== false) {
            return true;
        } else {
            return false;
        }
    }
    public function equals($field, $compare): bool{
        return $field === $compare;
    }

    public function isBoolean($field) {
        return is_bool($field);
    }

    public function isString($field): bool{
        return is_string($field);
    }
    public function isLength($field, array $config) :bool{
        if(isset($config['min'])) {
            return strlen((string) $field) >= $config['min'];
        }

        if(isset($config['max'])) {
            return strlen((string) $field) <= $config['max'];
        }
    }

    public function isEmail($string)
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL) !== false;
    }
}
