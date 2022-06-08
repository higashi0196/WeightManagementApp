<?php
class ErrorValidation {

   public $data = array();

   public function setData($data) {
      $this->data = $data;
   }
   
   public function getData($data) {
      return $this->data;
   }

   public function check() {
      $error_msgs = array();
      if (isset($this->data['title']) && empty($this->data['title'])) {
         $error_msgs[] = "タイトル空っぽ";
      }
      if (isset($this->data['content']) && empty($this->data['content'])) {
         $error_msgs[] = "目標空っぽ";
      }

      if(count($error_msgs) > 0) {
         return false;
      }
      
      return true;
   }
   
}

// public $error_sign = array();

// public function getErrorSign() {
//    return $this->error_sign;
// }


?>