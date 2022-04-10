<?php

// controllerフォルダ todocontroller

class Todocontroller {

   public function index() {
      $lists = Database::dbconnect();
      return $lists;
   }

   public function create() {

      $title = (filter_input(INPUT_POST, 'title'));
      $content = (filter_input(INPUT_POST, 'content'));

      $todo = new Database;
      $todo->setTitle($title);
      $todo->setContent($content);
      $result = $todo->save();

      header("Location: index.php");
   }

   public function edit() {

      $title = '';
      $content = '';
      $todo_id = '';
      
      $data = array(
         $todo_id = (filter_input(INPUT_POST, 'todo_id')),
         $title = (filter_input(INPUT_POST, 'title')),
         $content = (filter_input(INPUT_POST, 'content')),
      );
      
      // $param = array();
      // if($_SERVER['REQUEST_METHOD'] === 'GET') {
      //    if(isset($_GET['todo_id'])) {
      //       $todo_id = $_GET['todo_id'];
      //    }
      
      //    if(isset($_GET['title'])) {
      //       $title = $_GET['title'];
      //    }
      
      //    if(isset($_GET['content'])) {
      //       $content = $_GET['content'];
      //    }
      // }
      $param = array();
      if($_SERVER['REQUEST_METHOD'] === 'GET') {
         if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
         }
      
         if(isset($_GET['title'])) {
            $param['title'] = $_GET['title'];
         }
      
         if(isset($_GET['content'])) {
            $$param['content']  = $_GET['content'];
         }
      }

      $todo = Database::findId($todo_id);
      $data = array(
         "todo" => $todo,
         "param" => $param,
      );
      return $data; 

      $todo = new Database;
      $todo->setTitle($title);
      $todo->setContent($content);
      // $todo->setid($id);
      $result = $todo->update();
   }

}