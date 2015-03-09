<?php
namespace Models;
class ShowList {
  public function getFullList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist"); /*WHERE id= ? */
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    return $row;
  }
  public function getTopList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist ORDER BY soldq DESC LIMIT 3");
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    return $row;
  }
  public function getSaleList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist WHERE sale > 0");
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    return $row;
  }
  public function getItem($pdo, $id) {
    $st=$pdo->prepare("SELECT * FROM pricelist WHERE id= ?");
    $st->execute(array($id));
    $row=$st->fetchAll();
    return $row;
  }
  public function getCartList($pdo, $id) {
    $st=$pdo->prepare("SELECT * FROM pricelist WHERE id IN ?");
    $st->execute(array($id));
    $row=$st->fetchAll();
    return $row;
  }
  // public function hello($name) {
  //     return ", {$name}!";
  // }

}
