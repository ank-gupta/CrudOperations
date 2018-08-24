<?php

require_once 'Model/ToDoGateway.php';
require_once 'Model/TodoException.php';

class TodoService {
    
    private $toDoGateway    = NULL;
    
    private function openDb() {
        if (!mysql_connect("127.0.0.1", "root", "")) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("crud")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
    }
    
    private function closeDb() {
        mysql_close();
    }
    public function __construct() {
        $this->toDoGateway = new ToDoGateway();
    }
     public function getAllToDos($order) {
        try {
            $this->openDb();
            $res = $this->toDoGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
     public function getToDo($id) {
        try {
            $this->openDb();
            $res = $this->toDoGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->ToDoGateway->find($id);
    }
    
    private function validateTodoParams( $name, $status) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    
      public function createNewToDo( $name, $status) {
        try {
            $this->openDb();
            $this->validateTodoParams($name, $status);
            $res = $this->toDoGateway->insert($name, $status);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
      }
        public function deleteToDo( $id ) {
        try {
            $this->openDb();
            $res = $this->toDoGateway->delete($id);
            $this->closeDb();
             return $res;
           
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    }
   
    
