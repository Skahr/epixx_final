<?php
$Pg= new Models\OrderList();

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


  $Pg->postOrderItem($app['pdo'], $id, json_encode($c_o), $_POST['c_name'], $_POST['c_phone'], $_POST['r_b']);
}
elseif (isset($_POST['add'])) {
  $list=$Pg->getOrderItem($app['pdo'], $id);
  $c_o=rtrim($list['0']['c_order'], '}');
  $c_o.=',"'.$_POST['add'].'":"1"}';
  $Pg->postOrderField($app['pdo'], $id, $c_o);
}
else {
  $list=$Pg->getOrderItem($app['pdo'], $id);
  $c_o=json_decode($list['0']['c_order'], true);
    $rows_id='';
  foreach($c_o as $k => $v) {
    $rows_id.=$k.', ';
  }
  $Ps= new Models\ShowList();
  $order_list=$Ps->getCartList($app['pdo'], trim($rows_id,', '));

  $viewgen=$app['twig']->render('adm_order_id.html', array('list' => $list, 'order_list' => $order_list, 'c_o' => $c_o, 'o_id' => $id));
  $viewgen=combine($app, 'Заказ'.$id, $viewgen);
}
