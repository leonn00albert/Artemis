<?php

class Forms
{
    public $sanatize;
    public function __construct() {
        $this->sanatize = function ($req, $res) {
            foreach($req->body() as $key => $value) {
                $req->sanatized[$key] = $this->check_input($value);
     
            }
    
        };
    }

   private function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlentities($data);
        
        return htmlentities($data);
    }

}
