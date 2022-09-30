<?php

class Validation {

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

    public function setFileData($filedata) {
        $this->filedata = $filedata;
    }

    public function getFileData() {
        return $this->filedata;
    }

    public function getTokenErrorMessage() {
        return $this->token_error;
    }

    public function getTitleErrorMessage() {
        return $this->title_error;
    }

    public function getCotentErrorMessage() {
        return $this->content_error;
    }

    public function getWeightErrorMessage() {
        return $this->weight_error;
    }

    public function getBodyErrorMessage() {
        return $this->body_error;
    }

    public function getTodayErrorMessage() {
        return $this->today_error;
    }

    public function getPostErrorMessage() {
        return $this->post_error;
    }

    public function getFileErrorMessage() {
        return $this->file_error;
    }

    public function getFileModelErrorMessage() {
        return $this->filemodel_error;
    }

    public function getFileSizeErrorMessage() {
        return $this->filesize_error;
    }

    public function getCommentErrorMessage() {
        return $this->comment_error;
    }

    public function tokencheck() {
        if (
            empty($_POST['token']) ||
            empty($_SESSION['token']) ||
            $_SESSION['token'] !== filter_input(INPUT_POST, 'token')
            ) {
            $this->token_error[] = "不正なアクセスがありました";
            return false;
        }
    }

    public function todocheck() {

        if (empty($this->data['title']) && empty($this->data['content'])) {
            $this->title_error[] = "タイトルを入力してください";
            $this->content_error[] = "詳細を入力してください";
            return false;
        } 

        if (empty($this->data['title'])) {
            $this->title_error[] = "タイトルを入力してください";
            return false;
        } else if (50 < mb_strlen($this->data['title'], 'UTF-8')) {
            $this->title_error[] = "50文字以内で入力してください";
            return false;
        } 

        if (empty($this->data['content'])) {
            $this->content_error[] = "詳細を入力してください";
            return false;
        } else if (50 < mb_strlen($this->data['content'], 'UTF-8')) {
            $this->content_error[] = "50文字以内で入力してください";
            return false;
        }
    }

    public function weightheck() {

        if (empty($this->weightdata['body']) && 
            empty($this->weightdata['weight']) && 
            empty($this->weightdata['today'])) 
            {
            $this->body_error[] = "目標体重を入力してください";
            $this->weight_error[] = "体重を入力してください";
            $this->today_error[] = "日付が選択されていません";
            return false;
        } else if (empty($this->weightdata['body']) && 
            empty($this->weightdata['weight'])) 
            {
            $this->body_error[] = "目標体重を入力してください";
            $this->weight_error[] = "体重を入力してください";
            return false;
        } else if (empty($this->weightdata['body']) && 
            empty($this->weightdata['today'])) 
            {
            $this->body_error[] = "目標体重を入力してください";
            $this->today_error[] = "日付が選択されていません";
            return false;
        }

        if (empty($this->weightdata['weight']) && 
            empty($this->weightdata['today'])) 
            {
            $this->weight_error[] = "体重を入力してください";
            $this->today_error[] = "日付が選択されていません";
            return false;
        }

        if(empty($this->weightdata['body'])) {
            $this->body_error[] = "目標体重を入力してください";
            return false;
        } else if (!is_numeric($this->weightdata['body'])) {
            $this->body_error[] = "半角数字で入力してください";
            return false;
        } else if (6 < mb_strlen($this->weightdata['body'])) {
            $this->body_error[] = "５桁以下で小数点第２位以下までで入力ください";
            return false;
        }

        if (empty($this->weightdata['weight'])) {
            $this->weight_error[] = "体重を入力してください";
            return false;
        } else if (!is_numeric($this->weightdata['weight'])) {
            $this->weight_error[] = "半角数字で入力してください";
            return false;
        } else if (6 < mb_strlen($this->weightdata['weight'])) {
            $this->weight_error[] = "５桁以下で小数点第２位以下までで入力ください";
            return false;
        }

        if (empty($this->weightdata['today'])) {
            $this->today_error[] = "日付が選択されていません";
            return false;
        }
    }

    public function postcheck() {
        if (empty($this->content)) {
            $this->post_error[] = "メッセージを入力してください";
            return false;
        } else if (255 < mb_strlen($this->content, 'UTF-8')) {
            $this->post_error[] = "255文字以内で入力してください";
            return false;
        }
    }

    public function filecheck() {

        if (!is_uploaded_file($tmp_name) && empty($this->filedata['comment'])) {
            $this->file_error[] = "画像ファイルとメモを入力してください";
        } else if (!is_uploaded_file($tmp_name)) {
            $this->file_error[] = "画像ファイルが選択されていません";
        }
        
        $allow_ext = array('jpg','jpeg','png','gif');
        $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array(strtolower($file_ext), $allow_ext) && empty($this->filedata['comment'])) {
            $this->filemodel_error[] = "画像ファイルの末尾を｢jpg,jpeg,png,gif｣のどれかにして、メモを入力してください";
        } else if (!in_array(strtolower($file_ext), $allow_ext)) {
            $this->filemodel_error[] = "画像ファイルの形式を｢jpg,jpeg,png,gif｣のどれかにしてください";
        }

        if (1048576 < $this->filedata['filesize'] || $this->filedata['file_err'] == 2) {
            $this->filesize_error[] = "画像ファイルは1MB未満で送信してください";
            return false;
        }

        if (empty($this->filedata['comment'])) {
            $this->comment_error[] = "メモを入力してください";
            return false;
        } else if (255 < mb_strlen($this->filedata['comment'], 'UTF-8')) {
            $this->comment_error[] = "255文字以内で入力してください";
            return false;
        }
    }
  
}