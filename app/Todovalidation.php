
<?php

class TodoValidation {
    public $data = array();
    public $error_msgs = array();

    public function setData($data) {
        $this->data = $data;
    }

    public function takeData() {
        return $this->data;
    }

    public function getErrorMessages() {
        return $this->error_msgs;
    }

    public function check() {
        if(isset($this->data['title']) && empty($this->data['title'])) {
            $this->error_msgs[] = "タイトルが空です。";
        }
        if(isset($this->data['content']) && empty($this->data['content'])) {
            $this->error_msgs[] = "詳細が空です。";
        }

        if(count($this->error_msgs) > 0) {
            return false;
        }

        return true;
    }
}