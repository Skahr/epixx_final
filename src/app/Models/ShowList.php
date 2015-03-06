<?php
namespace Models;
class ShowList {
  public function getFullList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist"); /*WHERE id= ? */
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    $list=$row;
    return $list;
  }
  public function getTopList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist ORDER BY soldq DESC LIMIT 3");
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    $list=$row;
    return $list;
  }
  public function getSaleList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist WHERE sale > 0");
    $st->execute(); /*array('2')*/
    $row=$st->fetchAll();
    $list=$row;
    return $list;
  }
  public function hello($name) {
      return ", {$name}!";
  }

}
