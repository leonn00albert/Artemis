<?php
namespace Artemis\Core\Forms;
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

}
