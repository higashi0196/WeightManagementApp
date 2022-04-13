<?php

// controllerフォルダ todocontroller

class Todocontroller {

   public function index() {
      $lists = Database::dbconnect($query);
      return $lists;
   }

   public function create() {

      // $data = array(
      //    $title = (filter_input(INPUT_POST, 'title')),
      //    $content = (filter_input(INPUT_POST, 'content')),
      // );
      $title = (filter_input(INPUT_POST, 'title'));
      $content = (filter_input(INPUT_POST, 'content'));

      // $error_message = array();
      // if (empty($title)) {
      //    $error_message[] = "タイトルを入力してください". PHP_EOL;
      //    echo "タイトルを入力してください". PHP_EOL;
      // }
      // if (empty($content)) {
      //    $error_message[] = "目標を入力してください" . PHP_EOL;
      //    echo "目標を入力してください". PHP_EOL;
      // }
      // if (count($error_message) > 0) {
      //    $param = sprintf("$title=%scontent=%s", $title, $content);
      //    header(sprintf("Location: ./create.php", $param));
      // }
      // exit;

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
            // $title = $_GET['title'];
            $param['title'] = $_GET['title'];
         }
      
         if(isset($_GET['content'])) {
            // $content = $_GET['content'];
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
      // $todo->setTitle($title);
      // $todo->setContent($content);
      // $todo->setId($id);
      // $todo->setData($data);
      $todo->setId($data['todo_id']);
      $todo->setTitle($data['title']);
      $todo->setContent($data['content']);
      $result = $todo->update();

      header("Location: ./index.php");
   }

}