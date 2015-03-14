<?php
if (isset($_SESSION['cart'])) {
  $rows_id='';
  $rows_q=$_SESSION['cart'];
  foreach($rows_q as $k => $v) {
    $rows_id.=$k.', ';
  }
  $Pg= new Models\ShowList();
  $list=$Pg->getCartList($app['pdo'], trim($rows_id,', '));
}
else {
  $list='0';
  $rows_q='0';
}

$viewgen=$app['twig']->render('order.html', array('list' => $list, 'rows_q' => $rows_q));
$viewgen=combine($app, 'Оформление заказа', $viewgen);
