<?php

require_once 'Model/TodoService.php';

class ToDoController {
    
    private $toDoService = NULL;
    
    public function __construct() {
        $this->toDoService= new TodoService();
    }
  public function redirect($location) {
        header('Location: '.$location);
    }

 public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listTodo();
            } elseif ( $op == 'new' ) {
                $this->saveTodo();
            } elseif ( $op == 'delete' ) {
                $this->deleteTodo();
            } elseif ( $op == 'show' ) {
                $this->showTodo();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
    }
    public function listTodo() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $ToDos = $this->toDoService->getAllToDos($orderby);
        include 'view/ToDos.php';
    }
    
    public function saveTodo() {
       
        $title = 'Add new Todo';
        $name = '';
        $status = '';
        $errors = array();
        
        if ( isset($_POST['form-submitted'])) {
         
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $status     = isset($_POST['status'])?   $_POST['status'] :NULL;
            try {
                $this->toDoService->createNewTodo($name, $status);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/TodoForm.php';
    }
    
    public function deleteTodo() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        
        $this->toDoService->deleteTodo($id);
        
        $this->redirect('index.php');
    }
    
    public function showTodo() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $toDo = $this->toDoService->getTodo($id);
        
        include 'view/ToDo.php';
    }
    
    public function showError($title, $message) {
        include 'view/error.php';
    }
}