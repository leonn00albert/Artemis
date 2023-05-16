<?php


class Controller {
    public $handle_basic_request;

    public function __construct() {
    $this->handle_basic_request = function ($req,$res) {
        if($req->auth) {
           $res->send($res->body[0]->first_name);
        }
           
        };
    }
    
}