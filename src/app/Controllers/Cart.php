<?php
if (isset($_SESSION['cart'])) {
  foreach($_SESSION['cart'] as $k => $v) {
    $rows_id.=$k;
    $rows_q.=$v;
  }
  $Pg= new Models\ShowList();
  $list=$Pg->getCartList($app['pdo'], $rows);

}
else {
  $list='0';
}
$viewgen=$app['twig']->render('cart.html', array('list' => $list));
$viewgen=combine($app, 'Корзина', $viewgen);
