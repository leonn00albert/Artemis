<?php


class Controller {
    public $handleBasicRequest;

    public function __construct() {
    $this->handleBasicRequest = function ($req,$res) {
        if($req->auth) {
           $res->send($res->body[0]->first_name);
        }
           
        };
    }
    
}