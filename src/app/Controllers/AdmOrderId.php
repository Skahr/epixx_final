<?php
$Pg= new Models\OrderList();
$shortlist='';
if ((isset($_POST['order_ed']))||(isset($_POST['del']))) {
  foreach ($_POST as $k => $v) {
    if(($k!='order_ed')&&($k!='c_name')&&($k!='c_phone')&&($k!='r_b')&&($k!='del')) {
      if ($k==$_POST['del']) {
        unset($_POST[$k]);
      }
      else {
        $c_o[$k]=$_POST[$k];
      }
    }
  }
  if($_POST['r_b']=='fin'){
    $fin_check=$Pg->getOrderItem($app['pdo'], $id);
    if(($fin_check['0']['o_status']!='fin')&&($c_o)){
      $Sg= new Models\ShowList();
      $Sg->updateSoldq($app['pdo'], $c_o);
      setflash('Заказ выполнен. Soldq проданных товаров обновлено');
    }
  }
  if($c_o){
    $Pg->postOrderItem($app['pdo'], $id, json_encode($c_o), $_POST['c_name'], $_POST['c_phone'], $_POST['r_b']);
  }
  else {
    $Pg->postOrderItem($app['pdo'], $id, '', $_POST['c_name'], $_POST['c_phone'], $_POST['r_b']);

  }
}
elseif (isset($_POST['add'])) {
  $list=$Pg->getOrderItem($app['pdo'], $id);
  if($list['0']['c_order']){
    $c_o=json_decode($list['0']['c_order'], true);
    $c_o[$_POST['add']]++;
    $c_o=json_encode($c_o);
  }
  else {
    $c_o='{"'.$_POST['add'].'":1}';
  }
//  $c_o=rtrim($list['0']['c_order'], '}');
//  if($c_o) {
//    $c_o.=',"'.$_POST['add'].'":"1"}';
//  }
//  else {
//    $c_o.='{"'.$_POST['add'].'":"1"}';
//  }
  $Pg->postOrderField($app['pdo'], $id, $c_o);
}
else {
  $list=$Pg->getOrderItem($app['pdo'], $id);
  if($list['0']['c_order']){
  $c_o=json_decode($list['0']['c_order'], true);
    $rows_id='';
  foreach($c_o as $k => $v) {
    $rows_id.=$k.', ';
  }
  $Ps= new Models\ShowList();
  $order_list=$Ps->getCartList($app['pdo'], trim($rows_id,', '));
  }
  else {$order_list=''; $c_o='';}
  $viewgen=$app['twig']->render('adm_order_id.html', array('list' => $list, 'order_list' => $order_list, 'c_o' => $c_o, 'o_id' => $id));
  $viewgen=combine($app, 'Заказ'.$id, $viewgen);
}
