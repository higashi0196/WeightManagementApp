<?php
class TodoValidation {
   
   public $data = array();
   public $weightdata = array();
   public $content = array();
   public $title_errors = array();
   public $content_errors = array();
   public $all_errors = array();
   public $post_errors = array();
   public $weight_errors = array();
   public $body_errors = array();
   public $today_errors = array();
   
   public function setData($data) {
      $this->data = $data;
   }

   public function getData() {
      return $this->data;
   }

   public function setWeightData($weightdata) {
      $this->weightdata = $weightdata;
   }

   public function getWeightData() {
      return $this->weightdata;
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
   
   public function getWeightErrorMessages() {
      return $this->weight_errors;
   }

   public function getBodyErrorMessages() {
      return $this->body_errors;
   }

   public function getTodayErrorMessages() {
      return $this->today_errors;
   }
   
   public function titlecheck() {
      if(empty($this->data['title'])) {
         $this->title_errors[] = "タイトルが空です。";
         return false;
      } else if(50 < mb_strlen($this->data['title'], 'UTF-8')) {
         $this->title_errors[] = "タイトルは50文字以内で入力してください。";
         return false;
      } 
   }

   public function contentcheck() {
      if(empty($this->data['content'])){
         $this->content_errors[] = "目標が空です。";
         return false;
      } else if(255 < mb_strlen($this->data['content'], 'UTF-8')) {
         $this->content_errors[] = "目標は255文字以内で入力してください。";
         return false;
      } 
   }

   public function allcheck() {
      if(empty($this->data['title']) && empty($this->data['content'])) {
         $this->all_errors[] = "タイトルと目標が空です。";
         return false;
      }
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

   //   body = 目標の体重
   public function bodycheck() {
      if(isset($this->weightdata['body']) && empty($this->weightdata['body'])){
         $this->body_errors[] = "目標体重が空っぽです。";
         return false;
      } else if (!is_numeric($this->weightdata['body'])){
         $this->body_errors[] = "数字で入力してください。";
         return false;
      } else if (5 < mb_strlen($this->weightdata['body'])) {
         $this->body_errors[] = "入力ミス、５桁以下で小数点２以下までで入力ください。";
         return false;
      }
      return true;
   }

   // weight = 現在の体重
   public function weightcheck() {
      if(isset($this->weightdata['weight']) && empty($this->weightdata['weight'])){
         $this->weight_errors[] = "体重が空っぽです。";
         return false;
      } else if (!is_numeric($this->weightdata['weight'])){
         $this->weight_errors[] = "数字で入力してください。";
         return false;
      } else if (6 < mb_strlen($this->weightdata['weight'])) {
         $this->weight_errors[] = "入力ミス、５桁以下で小数点２以下までで入力ください。";
         return false;
      }
      return true;
   }

   // today
   public function todaycheck() {
      if(isset($this->weightdata['today']) && empty($this->weightdata['today'])){
         $this->today_errors[] = "日付が選択されていません。";
         return false;
      }
      return true;
   }
  
}

?>