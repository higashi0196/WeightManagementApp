<?php

// controllerフォルダ todocontroller

require_once('config.php');
require_once('error.php');

class Todocontroller {

   public function index() {
      $lists = Database::getAll();
      return $lists;
   }

   public function index2() {
      $wordlists = Database::getAll2();
      return $wordlists;
   }

   public function index3() {
      $bodylists = Database::getAll3();
      return $bodylists;
   }

   public function create() {
         
      $data = array(
         "title" => $_POST['title'],
         "content" => $_POST['content'],
     );

      $validation = new TodoValidation;
      $validation->setData($data);
      if($validation->allcheck() === false) {
         $all_errors = $validation->getAllErrorMessages();
         session_start();
         $_SESSION['all_errors'] = $all_errors;
         header("Location: ./create.php");
         return;
      } else if($validation->titlecheck() === false) {
         $title_errors = $validation->getTitleErrorMessages();
         session_start();
         $_SESSION['title_errors'] = $title_errors;
         header("Location: ./create.php");
         return;
      } else if($validation->contentcheck() === false) {
         $content_errors = $validation->getCotentErrorMessages();
         session_start();
         $_SESSION['content_errors'] = $content_errors;
         header("Location: ./create.php");
         return;
      }

      $validation_data = $validation->getData();

      $todo = new Database;
      $todo->setTitle($validation_data['title']);
      $todo->setcontent($validation_data['content']);
      $result = $todo->save();

      header("Location: ./index.php");
   }

   public function postcreate() {

      $content = (filter_input(INPUT_POST, 'postcontent'));

      $validation = new TodoValidation;
      $validation->setContent($content);

      if($validation->postcheck() === false) {
         $post_errors = $validation->getPostErrorMessages();
         session_start();
         $_SESSION['post_errors'] = $post_errors;
         header("Location: ./post.php");
         return;
      }
      
      $validation_content = $validation->getContent();

      $word = new Database;
      $word->setcontent($validation_content);
      $postresult = $word->postsave();

      header("Location: ./index.php");
   }

   public function dietcreate() {

      $body = (filter_input(INPUT_POST, 'body'));
      $weight = (filter_input(INPUT_POST, 'weight'));
      $today = (filter_input(INPUT_POST, 'today'));

      $physical = new Database;
      $physical->setbody($body);
      $physical->setweight($weight);
      $physical->settoday($today);
      $result = $physical->hold();

      header("Location: ./index.php");
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

      $validation = new TodoValidation;
      $validation->setData($data);
      if($validation->allcheck() === false) {
         $all_errors = $validation->getAllErrorMessages();
         session_start();
         $_SESSION['all_errors'] = $all_errors;
         header("Location: ./edit.php");
         return;
      } else if($validation->titlecheck() === false) {
         $title_errors = $validation->getTitleErrorMessages();
         session_start();
         $_SESSION['title_errors'] = $title_errors;
         header("Location: ./edit.php");
         return;
      } else if($validation->contentcheck() === false) {
         $content_errors = $validation->getCotentErrorMessages();
         session_start();
         $_SESSION['content_errors'] = $content_errors;
         header("Location: ./edit.php");
         return;
      }

      $validation_data = $validation->getData();

      $todo = new Database;
      $todo->setId($validation_data['todo_id']);
      $todo->setTitle($validation_data['title']);
      $todo->setcontent($validation_data['content']);
      $result = $todo->update();

      header("Location: ./index.php");
   }

   public function delete() {

      $todo_id = $_POST['todo_id'];

      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
   }

   public function postdelete() {

      $todo_id = $_POST['todo_id'];
      if (empty($todo_id)) {
         return;
      }

      $word = new Database;
      $word->setId($todo_id);
      $result2 = $word->postdelete();
      return $result2;
      
      header("Location: ./index.php");
   }

      // ここからした
   public function updateStatus() {
      error_log("updateStatus call.");
      $todo_id = $_POST['todo_id'];
      if(!$todo_id) {
          error_log(sprintf("[TodoController][updateStatus]todo_id id not found. todo_id: %s", $todo_id));
          return false;
      }

      // if(Database::isExistId($todo_id) === false) {
      //     error_log(sprintf("[TodoController][updateStatus]record is not found. todo_id: %s", $todo_id));
      //     return false;
      // }

      // $todo = Database::findId($todo_id);
      // if(!$todo) {
      //     error_log(sprintf("[TodoController][updateStatus]record is not found. todo_id: %s", $todo_id));
      //     return false;
      // }

      $status = $todo['status'];
      if($status == Database::STATUS_INCOMPLETE) {
          $status = Database::STATUS_COMPLETED;
      } else if($status == Database::STATUS_COMPLETED) {
          $status = Database::STATUS_INCOMPLETE;
      }

      $todo = new Todo;
      $todo->setId($todo_id);
      $todo->setStatus($status);
      $result = $todo->updateStatus();

      error_log(print_r($result, true));

      return $result;
  }

  public function completestatus() {

   $todo_id = $_POST['todo_id'];
   $todo = Database::findId($todo_id);

   $complete = $todo['complete'];
   if($complete === Database::complete_uncomplete) {
      $complete = Database::complete_uncomplete;
  } else if($complete === Database::complete_complete) {
      $complete = Database::complete_uncomplete;
  }

   $todo = new Database;
   $todo->setId($todo_id);
   $todo->setcomplete($complete);
   $result = $todo->updatecomplete();

   return $result;
   header("Location: ./index.php");
}
}