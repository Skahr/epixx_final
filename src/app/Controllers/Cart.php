<?php
if (isset($_SESSION['cart'])) {
  $rows_id='';
  $rows_q='';
  foreach($_SESSION['cart'] as $k => $v) {
    $rows_id.=$k.', ';
    $rows_q.=$v.', ';
  }
  $Pg= new Models\ShowList();
  //$id=trim($rows_id,', ');
  $list=$Pg->getCartList($app['pdo'], trim($rows_id,', '));
}
else {
  $list='0';
}

$viewgen=$app['twig']->render('cart.html', array('list' => $list));
$viewgen=combine($app, 'Корзина', $viewgen);
