<?php
class Todocontroller {
   public function index() {
      $lists = Database::dbconnect();
      return $lists;
   }
}