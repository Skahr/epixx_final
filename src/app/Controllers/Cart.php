<?php
if (isset($_POST['clearcart'])) {
  unset($_SESSION['cart']);
}
if (isset($_POST['q_ed'])) {
  //$_SESSION['vard']=var_dump($_POST);
  foreach ($_POST as $k => $v) {
    if($k!='q_ed') {
      $_SESSION['cart'][$k]=$_POST[$k];
    }
  }
}
if (isset($_SESSION['cart'])) {
  $rows_id='';
  $rows_q=$_SESSION['cart'];
  foreach($rows_q as $k => $v) {
    $rows_id.=$k.', ';
    //$rows_q.=$v.', ';

  }
  $Pg= new Models\ShowList();
  //$id=trim($rows_id,', ');
  $list=$Pg->getCartList($app['pdo'], trim($rows_id,', '));
}
else {
  $list='0';
  $rows_q='0';
}
$viewgen=$app['twig']->render('cart.html', array('list' => $list, 'rows_q' => $rows_q));
$viewgen=combine($app, 'Корзина', $viewgen);
