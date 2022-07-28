<?php
class TodoValidation {
   public function getData() {
      return $this->data;
   }
   
   public function setData($data) {
      $this->data = $data;
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

   public function getTokenErrorMessages() {
      return $this->token_errors;
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

   public function tokencheck() {
      if (
         empty($_POST['token']) ||
         empty($_SESSION['token']) ||
         $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
         ) {
            $this->token_errors[] = "不正なアクセスがありました。";
            return false;
      }
   }
   
   public function todocheck() {

      if(empty($this->data['title']) && empty($this->data['content'])) {
         $this->title_errors[] = "タイトルが空です。";
         $this->content_errors[] = "目標が空です。";
         return false;
      } 

      if(empty($this->data['title'])) {
         $this->title_errors[] = "タイトルが空です。";
         return false;
      } else if(50 < mb_strlen($this->data['title'], 'UTF-8')) {
         $this->title_errors[] = "50文字以内で入力してください。";
         return false;
      } 

      if(empty($this->data['content'])) {
         $this->content_errors[] = "目標が空です。";
         return false;
      } else if(50 < mb_strlen($this->data['content'], 'UTF-8')) {
         $this->content_errors[] = "50文字以内で入力してください。";
         return false;
      }
   }

   public function postcheck() {
      if(empty($this->content)) {
         $this->post_errors[] = "明日への一言が空です。";
         return false;
      } else if(255 < mb_strlen($this->content, 'UTF-8')) {
         $this->post_errors[] = "255文字以内で入力してください。";
         return false;
      }
   }

   public function weightheck() {

      if(empty($this->weightdata['body']) && 
         empty($this->weightdata['weight']) && 
         empty($this->weightdata['today'])) 
         {
         $this->body_errors[] = "目標体重が空っぽです。";
         $this->weight_errors[] = "体重が空っぽです。";
         $this->today_errors[] = "日付が選択されていません。";
         return false;
      } else if(empty($this->weightdata['body']) && 
         empty($this->weightdata['weight'])) 
         {
         $this->body_errors[] = "目標体重が空っぽです。";
         $this->weight_errors[] = "体重が空っぽです。";
         return false;
      } else if(empty($this->weightdata['body']) && 
         empty($this->weightdata['today'])) 
         {
         $this->body_errors[] = "目標体重が空っぽです。";
         $this->today_errors[] = "日付が選択されていません。";
         return false;
      }

      if(empty($this->weightdata['weight']) && 
         empty($this->weightdata['today'])) 
         {
         $this->weight_errors[] = "体重が空っぽです。";
         $this->today_errors[] = "日付が選択されていません。";
         return false;
      }

      if(empty($this->weightdata['body'])) {
         $this->body_errors[] = "目標体重が空っぽです。";
         return false;
      } else if (!is_numeric($this->weightdata['body'])) {
         $this->body_errors[] = "半角数字で入力してください。";
         return false;
      } else if (6 < mb_strlen($this->weightdata['body'])) {
         $this->body_errors[] = "５桁以下で小数点第２位以下までで入力ください。";
         return false;
      }

      if(empty($this->weightdata['weight'])) {
         $this->weight_errors[] = "体重が空っぽです。";
         return false;
      } else if (!is_numeric($this->weightdata['weight'])) {
         $this->weight_errors[] = "半角数字で入力してください。";
         return false;
      } else if (6 < mb_strlen($this->weightdata['weight'])) {
         $this->weight_errors[] = "５桁以下で小数点第２位以下までで入力ください。";
         return false;
      }

      if(empty($this->weightdata['today'])) {
         $this->today_errors[] = "日付が選択されていません。";
         return false;
      }
   }
  
}

?>