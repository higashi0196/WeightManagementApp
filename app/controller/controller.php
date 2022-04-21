<?php

// controllerフォルダ todocontroller

require_once('config.php');

class Todocontroller {

   public function index() {
      // $lists = Database::dbconnect($query);
      $lists = Database::getAll();
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
      $todo_id = '';
      $param = array();

      if($_SERVER['REQUEST_METHOD'] === 'GET') {
         if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
         }
         if(isset($_GET['title'])) {
            $param['title'] = $_GET['title'];
         }
         if(isset($_GET['content'])) {
            $param['content'] = $_GET['content'];
         }
      }

      $todo = Database::findId($todo_id);

      $data = array(
         "todo" => $todo,
         "param" => $param,
     );
      return $data;
 }
   
   public function update() {

      $data = array(
         "todo_id" => $_POST['todo_id'],
         "title" => $_POST['title'],
         "content" => $_POST['content'],
      );
   
      $todo = new Database;
      $datasetting = new Database;

      $datasetting->setData($data);
      $dataset = $datasetting->takeData();
      $todo->setId($dataset['todo_id']);
      $todo->setTitle($dataset['title']);
      $todo->setContent($dataset['content']);

      $result = $todo->update();
      header("Location: ./index.php");
   }

   public function delete() {
      $todo_id = $_POST['todo_id'];
      if (empty($todo_id)) {
         return;
         }

      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
      // header("Location: ./index.php");
   }

}