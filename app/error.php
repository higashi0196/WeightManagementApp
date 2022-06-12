<?php
class TodoValidation {
   
   public $data = array();
   public $content = array();
   public $title_errors = array();
   public $content_errors = array();
   public $all_errors = array();
   public $post_errors = array();
   
   public function setData($data) {
      $this->data = $data;
   }

   public function getData() {
      return $this->data;
   }
   
   public function setContent($content) {
      $this->content = $content;
   }
   
   public function getContent() {
      return $this->content;
   }

   public function getTitleErrorMessages() {
      return $this->title_errors;
   }
   
   public function getCotentErrorMessages() {
      return $this->content_errors;
   }

   public function getAllErrorMessages() {
      return $this->all_errors;
   }
   
   public function getPostErrorMessages() {
      return $this->post_errors;
   }
   
  public function titlecheck() {
      if(isset($this->data['title']) && empty($this->data['title'])) {
         $this->title_errors[] = "タイトルが空です。";
         return false;
      } else if(50 < mb_strlen($this->data['title'], 'UTF-8')) {
         $this->title_errors[] = "タイトルは50文字以内で入力してください。";
         return false;
      }
      return true;
   }

  public function contentcheck() {
      if(isset($this->data['content']) && empty($this->data['content'])){
         $this->content_errors[] = "目標が空です。";
         return false;
      } else if(255 < mb_strlen($this->data['content'], 'UTF-8')) {
         $this->content_errors[] = "目標は255文字以内で入力してください。";
         return false;
      }
      return true;
   }

  public function allcheck() {
      if(isset($this->data['title']) && empty($this->data['title']) && isset($this->data['content']) && empty($this->data['content'])) {
         $this->all_errors[] = "タイトルと目標が空です。";
         return false;
      }
      return true;
   }

  public function postcheck() {
   if(isset($this->content) && empty($this->content)){
      $this->post_errors[] = "明日への一言が空です。";
      return false;
   } else if(255 < mb_strlen($this->content, 'UTF-8')) {
      $this->post_errors[] = "明日への一言は255文字以内で入力してください。";
      return false;
   }
      return true;
   }
   

}

?>