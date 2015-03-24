<?php
namespace Models;
class ShowList {
  public function getCatLinks($pdo) {
    $st=$pdo->prepare("SELECT name_en, name_ru FROM category");
    $st->execute();
    $row=$st->fetchAll();
    return $row;
  }
  public function getFullList($pdo, $cat, $sort) {
    $st="SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat";
    if(!empty($cat)) {
      $st.=" WHERE category.name_en=?";
    }
    if (!empty($sort)) {
      if($sort=='price_asc') {
        $st.=" ORDER BY price ASC";
      }
      if($sort=='price_desc') {
        $st.=" ORDER BY price DESC";
      }
      if($sort=='soldq_asc') {
        $st.=" ORDER BY soldq ASC";
      }
      if($sort=='soldq_desc') {
        $st.=" ORDER BY soldq DESC";
      }
    }
    $st=$pdo->prepare($st);
    $st->execute(array($cat));
    $row=$st->fetchAll();
    return $row;
  }
//  public function getByCategory($pdo, $cat) {
//    $st=$pdo->prepare("SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat WHERE category.name_en= ?");
//    $st->execute(array($cat));
//    $row=$st->fetchAll();
//    return $row;
//  }
  public function getTopList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat ORDER BY soldq DESC LIMIT 3");
    $st->execute();
    $row=$st->fetchAll();
    return $row;
  }
  public function getSaleList($pdo) {
    $st=$pdo->prepare("SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat WHERE sale > 0");
    $st->execute();
    $row=$st->fetchAll();
    return $row;
  }
  public function getItem($pdo, $id) {
    $st=$pdo->prepare("SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat WHERE id= ?");
    $st->execute(array($id));
    $row=$st->fetchAll();
    return $row;
  }
  public function getCartList($pdo, $id) {
    $sql="SELECT * FROM pricelist JOIN category ON pricelist.id_cat=category.id_cat WHERE id IN (".$id.")";
    //echo $sql;
    $st=$pdo->prepare($sql);//"SELECT * FROM pricelist WHERE id IN ( ? )");
    $st->execute();//array($id));
    $row=$st->fetchAll();
    return $row;
  }
  public function postItemToDb($pdo, $name, $cat, $description, $img, $price, $sale, $units, $q){
    $st=$pdo->prepare("INSERT INTO pricelist (name, category, description, img, price, sale, units, q) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $st->execute(array($name, $cat, $description, $img, $price, $sale, $units, $q));
  }
  public function postItemToDbUpdate($pdo, $id, $name, $cat, $description, $img, $price, $sale, $units, $q, $soldq) {
    $st=$pdo->prepare("UPDATE pricelist SET name=?, id_cat=?, description=?, img=?, price=?, sale=?, units=?, q=?, soldq=? WHERE id=?");
    $st->execute(array($name, $cat, $description, $img, $price, $sale, $units, $q, $soldq, $id));
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
