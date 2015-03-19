<?php
namespace Models;
class UserList {
  public function checkPassword($pdo, $email) {
    $st=$pdo->prepare("SELECT id, password FROM users WHERE email=?");
    $st->execute(array($email));
    $rows = $st->fetchAll();
    return $rows;
  }
  public function changePassword($pdo, $id, $pass) {
    $st=$pdo->prepare("UPDATE users SET password=? WHERE id=?");
    $st->execute(array($pass, $id));
  }
}