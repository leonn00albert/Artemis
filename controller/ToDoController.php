<?php
require_once "Artemis\db\DB.php";
require_once "todo.php";
$db = new db("JSON","todo");
$todo = new ToDo();
class ToDoController
{
    public $getToDo;
    public $addToDo;
    public $deleteAllToDo;
    public $checkToDo;
    public $deleteToDoById;

    public function __construct()
    {
        $this->getToDo = function ($req, $res) {
            global $db;
            global $todo;
            $data = $db->con->find([]);
            $res->json($todo->render_list((array)$data));
        };

        $this->addToDo = function ($req, $res) {
            global $db;
            global $todo;
            $input = $req->sanatized;    
            $data = $db->con->create([["txt" => $input['input'], "checked" => ""]]);
            $res->json($todo->render_list((array)$data));
        };
        $this->checkToDo = function ($req, $res) {
            global $todo; 
            global $db; 
            $elm = (array)$db->con->findById($req->params()['id'])[0];
          
            if($elm['checked'] === "checked") {
              $data =  $db->con->updateById($req->params()['id'],['checked' => '']);
            }else {
              $data =  $db->con->updateById($req->params()['id'],['checked' => 'checked']);
            }
          
            $res->json($todo->render_list((array)$data));
        };
        $this->deleteAllToDo = function ($req, $res) {
            global $todo;
            global $db;
            $data =  $db->con->deleteMany([]);
            $res->json($todo->render_list((array)$data));
        };

        $this->deleteToDoById = function ($req, $res) {
            global $todo;
            global $db; 
            $id = $req->params()['id'];
            $data =  $db->con->deleteById($id);
            $res->json($todo->render_list((array)$data));
        };

    }
}
