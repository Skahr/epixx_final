<?php
namespace Models;
class OrderList {
  public function postOrder($pdo, $order, $c_name, $c_phone) {
    $st=$pdo->prepare("INSERT INTO orders (c_order, c_name, c_phone, o_status) VALUES (?, ?, ?, 'new')");
    $st->execute(array($order, $c_name, $c_phone));
  }
  public function getOrderList($pdo) {
    $st=$pdo->prepare("SELECT * FROM orders");
    $st->execute();
    $row=$st->fetchAll();
    return $row;
  }
  public function getOrderItem($pdo, $id) {
    $st=$pdo->prepare("SELECT * FROM orders WHERE id=?");
    $st->execute(array($id));
    $row=$st->fetchAll();
    return $row;
  }
  public function postOrderItem($pdo, $id, $order, $c_name, $c_phone, $o_status)
  {
    $st=$pdo->prepare("UPDATE orders SET c_order=?, c_name=?, c_phone=?, o_status=? WHERE id=?");
    $st->execute(array($order, $c_name, $c_phone, $o_status, $id));
  }
  public function postOrderField($pdo, $id, $order){
    $st=$pdo->prepare("UPDATE orders SET c_order=? WHERE id=?");
    $st->execute(array($order, $id));
  }
}
