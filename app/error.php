<?php
class TodoValidation {
   
   public $data = array();
   public $error_msgs = array();
   public $content_msgs = array();
   public $all_msgs = array();

   public function setData($data) {
      $this->data = $data;
   }
   public function getData() {
      return $this->data;
   }

   public function getTitleErrorMessages() {
      return $this->title_msgs;
   }
   
   public function getCotentErrorMessages() {
      return $this->content_msgs;
   }
   
   public function getAllErrorMessages() {
      return $this->all_msgs;
   }

  public function titlecheck() {
      if(isset($this->data['title']) && empty($this->data['title'])) {
         $this->title_msgs[] = "タイトルが空です。";
         return false;
      } else if(50 < mb_strlen($this->data['title'], 'UTF-8')) {
         $this->title_msgs[] = "タイトルは50文字以内で入力してください。";
         return false;
      }
      return true;
   }

  public function contentcheck() {
      if(isset($this->data['content']) && empty($this->data['content'])){
         $this->content_msgs[] = "目標が空です。";
         return false;
      } else if(255 < mb_strlen($this->data['content'], 'UTF-8')) {
         $this->content_msgs[] = "目標は255文字以内で入力してください。";
         return false;
      }
      return true;
   }

  public function allcheck() {
      if(isset($this->data['title']) && empty($this->data['title']) && isset($this->data['content']) && empty($this->data['content'])) {
         $this->all_msgs[] = "タイトルと目標が空です。";
         return false;
      }
      return true;
   }
}

?>