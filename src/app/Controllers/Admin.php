<?php
if (isset($_POST['logout'])) {
  unset($_SESSION['login']);
}
else {
  $Pg= new Models\OrderList();
  $list=$Pg->getOrderList($app['pdo']);

  $viewgen=$app['twig']->render('admin.html', array('admin' => $_SESSION['login'], 'list' => $list));
  $viewgen=combine($app, 'Админка', $viewgen);
}
