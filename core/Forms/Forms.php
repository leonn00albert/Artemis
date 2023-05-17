<?php

class Forms
{
    public $sanatize;
    public function __construct() {
        $this->sanatize = function ($req, $res) {
            foreach($req->body() as $key => $value) {
                $req->sanatized[$key] = $this->checkInput($value);
     
            }
    
        };
    }

   private function checkInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlentities($data);
        
        return htmlentities($data);
    }

}
