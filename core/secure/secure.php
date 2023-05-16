<?php
// use strategy

namespace Artemis\Core\Secure;
class SimpleLogin
{
    public $login;

    public function __construct()
    {
        $this->login = function ($req, $res) {
            if ($req->body['user'] === "leon" && $req->body['pwd'] === '12345') {
                $req->auth = True;

            } else {
                $req->auth = False;
                $res->send("login fail");
            }

        };
    }

}
