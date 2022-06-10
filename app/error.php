<?php
class TodoValidation {
   public $title= array();
   public $content= array();
   public $error_msgs= array();

   public function setTitle($title) {
      $this->title = $title;
   }

   public function takeTitle() {
      return $this->title;
   }
   
   public function setContent($content) {
      $this->content = $content;
   }

   public function takeContent() {
      return $this->content;
   }

   public function setErrorMessages() {
      return $this->error_msgs;
  }

  public function createcheck() {
      if(isset($this->title['title']) && empty($this->title['title'])) {
         $this->error_msgs[] = "タイトルが空です。";
      }
      if(isset($this->content['content']) && empty($this->content['content'])) {
         $this->error_msgs[] = "タイトルが空です。";
      }
      if(count($this->error_msgs) > 0) {
         return false;
     }
  }

}

$errors = [];



?>