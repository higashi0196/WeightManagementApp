<?php

// controllerフォルダ todocontroller

require_once('config.php');
require_once('Todovalidation.php');

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

      // header("Location: index.php");
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

      if(!$todo_id) {
          header("Location: ./../error/404.php");
          return;
      }

      if(Database::isExistById($todo_id) === false) {
          header("Location: ./../error/404.php");
          return;
      }

      $todo = Database::findId($todo_id);
      if(!$todo) {
          header("Location: ./../error/404.php");
          return;
      }
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
      // $todo = new Database;
      // $todo->setTitle($title);
      // $todo->setContent($content);
      // $todo->setContent($id);
      // ↓更新
      $validation = new TodoValidation;
      $validation->setData($data);
      // if($validation->check() === false) {
      //    $error_msgs = $validation->getErrorMessages();

      //    session_start();
      //    $_SESSION['error_msgs'] = $error_msgs;

      //    $param = sprintf("?todo_id=%s&title=%s&content=%s", $_POST['todo_id'], $_POST['title'], $_POST['content']);
      //    header(sprintf("Location: ./edit.php%s", $param));
      //    return;
      // }

      $valid_data = $validation->takeData();

      $todo = new Database;
      $todo->setId($valid_data['todo_id']);
      $todo->setTitle($valid_data['title']);
      $todo->setContent($valid_data['content']);

      $result = $todo->update();
      // header("Location: ./index.php");
   }

   public function delete() {
      $todo_id = filter_input(INPUT_POST, 'todo_id');
      if (empty($todo_id)) {
         return;
         }
      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
   }

}