<?php

require_once('./../../../config/config.php');

class Database
{  
    public $id;
    public $title;
    public $content;
    public $body;
    public $weight;
    public $today;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getToday() {
        return $this->today;
    }

    public function setToday($today) {
        $this->today = $today;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    // todosテーブルのid取得
    public function todogetid($id) {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM todos WHERE id = :id";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();
            $todo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $todo;

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // todosテーブルのデータを全て取得
    public static function todogetAll() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM todos";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $todolists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $todolists;

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // todosテーブルにtitle(タイトル),content(詳細)のデータ保存
    public function save() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "INSERT INTO todos (title, content, created_at, updated_at) VALUES ('$this->title', '$this->content', NOW(), NOW())";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('title', $title);
            $stmt->bindValue('content', $content);
            $stmt->execute();

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // todosテーブルにtitle(タイトル),content(詳細)のデータを更新
    public function update() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "UPDATE todos SET title = '$this->title', content = '$this->content', updated_at = NOW() WHERE id = '$this->id'";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('title', $title);
            $stmt->bindValue('content', $content);
            $stmt->bindValue('id', $id);
            $stmt->execute();

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }   
    }

    // todosテーブルのis_doneカラム ture,falseを更新
    // 1 = true, 0 = false として,insert時はfalseにて保存
    public function toggle($id) {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "UPDATE todos SET is_done = NOT is_done, updated_at = NOW() WHERE id = :id";
            
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id', $id, \PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // todosテーブルのデータを削除
    public function tododelete() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "DELETE FROM todos WHERE id = $this->id";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }   
    }

    // postsテーブルの最新データのみ取得
    public static function postgetAll() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 1";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $wordlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $wordlists;

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // postsテーブルのcontentデータを保存
    public function postsave() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "INSERT INTO posts (content, created_at) VALUES ('$this->content', NOW())";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('content', $content);
            $stmt->execute();

            $pdo->commit();

        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // postsテーブルの全てのデータを削除
    public function postdelete() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "TRUNCATE TABLE posts";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }   
    }

    // bodiesテーブルの最新データのみ取得
    public static function weightsgetAll() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM bodies ORDER BY id DESC LIMIT 1";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $bodylists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $bodylists;

            $pdo->commit();
            
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // bodiesテーブルのgoalweights(目標体重)の最新データのみ取得
    public static function goalget() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT goalweights FROM bodies ORDER BY id DESC LIMIT 1";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $goallists = $stmt->fetch(PDO::FETCH_ASSOC);
            return $goallists;

            $pdo->commit();
        
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // bodiesテーブルのnowweights(現体重) - goalweights(目標体重)にて
    // 最新データのみ取得
    public static function gapget() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT nowweights - goalweights FROM bodies ORDER BY id DESC LIMIT 1";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $difference = $stmt->fetch(PDO::FETCH_ASSOC);
            return $difference;

            $pdo->commit();
        
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // bodiesテーブルにデータを保存
    // nowweights(現在の体重)
    // goalweights(目標体重) 
    // nowdate(現在の日付)
    public function weightsave() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('$this->weight', '$this->body', '$this->today')";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('nowweights', $weight);
            $stmt->bindValue('goalweights', $body);
            $stmt->bindValue('nowdate', $today);
            $stmt->execute();

            $pdo->commit();
        
        } catch (Exception $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }
    }

    // picturesテーブルのデータを取得
    public static function fileAllget() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "SELECT * FROM pictures";

            $pdo->beginTransaction();
            $stmt = $pdo->query($sql);
            $filelists = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $filelists;

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }  
    }

    // picturesテーブルにデータを保存
    // $filename(ファイル名),
    // $save_path(保存先のパス),
    // $image(保存先のパスのバイナリデータ),
    // $comment(一言メモ)
    public function filesave($filename,$image,$comment) {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "INSERT INTO pictures (file_name, tmp_name, comment, created_at) VALUES ('$filename', '$image', '$comment', NOW())";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('file_name', $filename);
            $stmt->bindValue('tmp_name', $image);
            $stmt->bindValue('comment', $comment);
            $stmt->execute();

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }   
    }

    // picturesテーブルのデータを削除
    public function filedelete() {
        try {
            // $pdo = new PDO(DSN, USER, PASSWORD);
            $pdo = new PDO($dsn,$user,$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $sql = "DELETE FROM pictures WHERE id = $this->id";

            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id', $id);
            $stmt->execute();

            $pdo->commit();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            header("Location: ./../../view/error/404.html");

            $pdo->rollBack();
            exit;
        }   
    }      
}