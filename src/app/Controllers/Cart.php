<?php


if (isset($_POST['order'])) { //
  $_SESSION['order']='1';
  foreach ($_POST as $k => $v) {
    if($k!='order') {
      $_SESSION['cart'][$k]=$_POST[$k];
    }
  }

}
elseif (isset($_POST['backtocart'])) {
  unset($_SESSION['order']);
}
elseif (isset($_POST['clearcart'])) { //очистка корзины
  unset($_SESSION['cart']);
}
elseif (isset($_POST['q_ed'])) { //изменение кол-ва товаров
  foreach ($_POST as $k => $v) {
    if($k!='q_ed') {
      $_SESSION['cart'][$k]=$_POST[$k];
    }
  }
}
elseif (isset($_POST['del'])) { //изменение кол-ва товаров
  foreach ($_POST as $k => $v) {
    if($k!='del') {
      $_SESSION['cart'][$k]=$_POST[$k];
    }
  }
  unset($_SESSION['cart'][$_POST['del']]);
}

else {
    $tw_template='cart.html';
    $tw_title='Корзина';
  if (isset($_SESSION['cart'])) { //генерация корзины
    $rows_id='';
    $rows_q=$_SESSION['cart'];
    foreach($rows_q as $k => $v) {
      $rows_id.=$k.', ';
    }
    $Pg= new Models\ShowList();
    $list=$Pg->getCartList($app['pdo'], trim($rows_id,', '));
    if (isset($_SESSION['order'])) { //генерация оформления заказа
      $tw_template='order.html';
      $tw_title='Оформление заказа';
    }
  }
  else {
    $list='0';
    $rows_q='0';
  }
  $viewgen=$app['twig']->render($tw_template, array('list' => $list, 'rows_q' => $rows_q));
  $viewgen=combine($app, $tw_title, $viewgen);
}
