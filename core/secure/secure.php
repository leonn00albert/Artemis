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



class Secure
{
    /**
     * @var SecureStrategy The Context maintains a reference to one of the Strategy
     * objects. The Context does not know the concrete class of a strategy. It
     * should work with all strategies via the Strategy interface.
     */
    private $strategy;
    public $authenticate;
    public function use(SecureStrategy $strategy)
    {
        $this->strategy = $strategy;
        $this->authenticate = $strategy->authenticate;
    }

  
}


interface SecureStrategy
{
    public function register(array $data): array;
    public function authenticate();
}


class Local implements SecureStrategy
{
    public $authenticate;

    public function __construct()
    {
        $this->authenticate = function ($req, $res) {
            if ($req->body()['user'] === "leon" && $req->body()['password'] === '12345') {
                $req->auth = True;

            } else {
                $req->auth = False;
                $res->send("login fail");
            }

        };
    }
        
    public function authenticate()  
    {
        return $this->authenticate;
    }
    public function register(array $data): array
    {
        sort($data);

        return $data;
    }

}


