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
    $sql="SELECT * FROM pricelist WHERE id IN (".$id.")";
    //echo $sql;
    $st=$pdo->prepare($sql);//"SELECT * FROM pricelist WHERE id IN ( ? )");
    $st->execute();//array($id));
    $row=$st->fetchAll();
    return $row;
  }
  public function postItemToDb($pdo, $name, $description, $img, $price, $sale, $units, $q){
    $st=$pdo->prepare("INSERT INTO pricelist (name, description, img, price, sale, units, q) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $st->execute(array($name, $description, $img, $price, $sale, $units, $q));
  }
  public function postItemToDbUpdate($pdo, $id, $name, $description, $img, $price, $sale, $units, $q, $soldq) {
    $st=$pdo->prepare("UPDATE pricelist SET name=?, description=?, img=?, price=?, sale=?, units=?, q=?, soldq=? WHERE id=?");
    $st->execute(array($name, $description, $img, $price, $sale, $units, $q, $soldq, $id));
  }
  public function postPicToDb($pdo, $id, $img) {
    $st=$pdo->prepare("UPDATE pricelist SET img=? WHERE id=?");
    $st->execute(array($img, $id));
  }
  public function checkName($pdo, $name){
    $st=$pdo->prepare("SELECT id FROM pricelist WHERE name= ?");
    $st->execute(array($name));
    $row=$st->fetchAll();
    return $row;
  }
  public function updateSoldq($pdo, $c_o) {
    foreach ($c_o as $k => $v) {
      $st=$pdo->prepare("UPDATE pricelist SET soldq=soldq+? WHERE id=?");
      $st->execute(array($v, $k));
    }
  }
  // public function hello($name) {
  //     return ", {$name}!";
  // }

}
