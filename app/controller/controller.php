<?php

// controllerフォルダ todocontroller

require_once('config.php');
require_once('error.php');

class Todocontroller {

   public function picturecreate() {

      $picture = new Database;
      $pictureresult = $picture->picturesave();

      header("Location: ./index.php");
   }

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

   public function index4() {
      $goallists = Database::getAll4();
      return $goallists;
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

         $params = sprintf("?todo_id=%s&title=%s&content=%s", $_POST['todo_id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./create.php%s", $params));
         return;
      } else if($validation->titlecheck() === false) {
         $title_errors = $validation->getTitleErrorMessages();
         session_start();
         $_SESSION['title_errors'] = $title_errors;

         $params = sprintf("?todo_id=%s&title=%s&content=%s", $_POST['todo_id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./create.php%s", $params));
         return;
      } else if($validation->contentcheck() === false) {
         $content_errors = $validation->getCotentErrorMessages();
         session_start();
         $_SESSION['content_errors'] = $content_errors;

         $params = sprintf("?todo_id=%s&title=%s&content=%s",$_POST['todo_id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./create.php%s", $params));
         return;
      }

      $validation_data = $validation->getData();

      $todo = new Database;
      $todo->setTitle($validation_data['title']);
      $todo->setContent($validation_data['content']);
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

      $weightdata = array(
         "body" => $_POST['body'],
         "weight" => $_POST['weight'],
         "today" => $_POST['today'],
      );

      $validation = new TodoValidation;
      $validation->setWeightData($weightdata);

      if($validation->weighttodaycheck() === false) {
         $weighttoday_errors = $validation->getWeightTodayErrorMessages();
         session_start();
         $_SESSION['weighttoday_errors'] = $weighttoday_errors;

         $weightparams = sprintf("?body=%s&weight=%s&today=%s", $_POST['body'], $_POST['weight'], $_POST['today']);
         header(sprintf("Location: ./weight.php%s", $weightparams));
         return;
      } else if($validation->weightcheck() === false) {
         $weight_errors = $validation->getWeightErrorMessages();
         session_start();
         $_SESSION['weight_errors'] = $weight_errors;

         $weightparams = sprintf("?body=%s&weight=%s&today=%s", $_POST['body'], $_POST['weight'], $_POST['today']);
         header(sprintf("Location: ./weight.php%s", $weightparams));
         return;
      } else if($validation->bodycheck() === false) {
         $body_errors = $validation->getBodyErrorMessages();
         session_start();
         $_SESSION['body_errors'] = $body_errors;

         $weightparams = sprintf("?body=%s&weight=%s&today=%s", $_POST['body'], $_POST['weight'], $_POST['today']);
         header(sprintf("Location: ./weight.php%s", $weightparams));
         return;
      } else if ($validation->todaycheck() === false){
         $today_errors = $validation->getTodayErrorMessages();
         session_start();
         $_SESSION['today_errors'] = $today_errors;

         $weightparams = sprintf("?body=%s&weight=%s&today=%s", $_POST['body'], $_POST['weight'], $_POST['today']);
         header(sprintf("Location: ./weight.php%s", $weightparams));
         return;
      }

      $validation_weightdata = $validation->getWeightData();

      $physical = new Database;
      $physical->setbody($validation_weightdata['body']);
      $physical->setweight($validation_weightdata['weight']);
      $physical->settoday($validation_weightdata['today']);
      $weightresult = $physical->weightsave();

      header("Location: ./index.php");
   }

   public function edit() {

      $todo_id = '';
      $params = array();
      if($_SERVER['REQUEST_METHOD'] === 'GET') {
         if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
         }
         if(isset($_GET['title'])) {
            $params['title'] = $_GET['title'];
         }
         if(isset($_GET['content'])) {
            $params['content'] = $_GET['content'];
         }
      }

      $todo = Database::findId($todo_id);
      
      $data = array(
         "todo" => $todo,
         "params" => $params,
      );
      
      return $data;
   }  
   
   public function update() {

      $data = array(
         "id" => $_POST['id'],
         "title" => $_POST['title'],
         "content" => $_POST['content'],
      );

      $validation = new TodoValidation;
      $validation->setData($data);

      if($validation->allcheck() === false) {
         $all_errors = $validation->getAllErrorMessages();
         session_start();
         $_SESSION['all_errors'] = $all_errors;

         $params = sprintf("?id=%s&title=%s&content=%s",$_POST['id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./edit.php%s", $params));
         return;
      } else if($validation->titlecheck() === false) {
         $title_errors = $validation->getTitleErrorMessages();
         session_start();
         $_SESSION['title_errors'] = $title_errors;

         $params = sprintf("?id=%s&title=%s&content=%s",$_POST['id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./edit.php%s", $params));
         return;
      } else if($validation->contentcheck() === false) {
         $content_errors = $validation->getCotentErrorMessages();
         session_start();
         $_SESSION['content_errors'] = $content_errors;

         $params = sprintf("?id=%s&title=%s&content=%s",$_POST['id'], $_POST['title'], $_POST['content']);
         header(sprintf("Location: ./edit.php%s", $params));
         return;
      }
   
      $validation_data = $validation->getData();

      $todo = new Database;
      $todo->setId($validation_data['id']);
      $todo->setTitle($validation_data['title']);
      $todo->setcontent($validation_data['content']);
      $result = $todo->update();

      header("Location: ./index.php");
   }

   public function delete() {

      $todo_id = $_POST['todo_id'];
      if($_SERVER['REQUEST_METHOD'] === 'GET') {
         if(isset($_GET['todo_id'])) {
            $todo_id = $_GET['todo_id'];
         }
      }

      $todo = new Database;
      $todo->setId($todo_id);
      $result = $todo->delete();

      return $result;
   }

   public function postdelete() {

      $word = new Database;
      $postresult = $word->postdelete();
      return $postresult;
      
   }

}