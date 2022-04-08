<?php

// controllerフォルダ todocontroller

class Todocontroller {

   public function index() {
      $lists = Database::dbconnect();
      return $lists;
   }

   public function create() {

      // $data = array(
      // $title = (filter_input(INPUT_POST, 'title')),
      // $content = (filter_input(INPUT_POST, 'content')),
      // );
      $title = (filter_input(INPUT_POST, 'title'));
      $content = (filter_input(INPUT_POST, 'content'));

      $todo = new Database;
      $todo->setTitle($title);
      $todo->setContent($content);
      $result = $todo->save();

      header("Location: index.php");
   }

   public function edit() {
      $todo_id = (filter_input(INPUT_GET, 'id'));
      $title = (filter_input(INPUT_POST, 'title'));
      $content = (filter_input(INPUT_POST, 'content'));

      $todo = database::findId($todo_id);
      return $todo; 

      $todo = new Database;
      $todo->setTitle($title);
      $todo->setContent($content);
      $todo->setid($id);
      $result = $todo->update();
   }

}