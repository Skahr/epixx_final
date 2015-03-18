<?php
if (isset($_POST['logout'])) {
  unset($_SESSION['login']);
  unset($_SESSION['ed_mode']);
}
elseif (isset($_POST['ed_mode'])) {
  if(isset($_SESSION['ed_mode'])) {
    unset($_SESSION['ed_mode']);
  }
  else {
    $_SESSION['ed_mode']='1';
  }
}
else {
  if(isset($_SESSION['ed_mode'])) {
    $ed='1';
  }
  else {
    $ed='';
  }
  $Pg= new Models\OrderList();
  $list=$Pg->getOrderList($app['pdo']);

  $viewgen=$app['twig']->render('admin.html', array('admin' => $_SESSION['login'], 'list' => $list, 'ed' => $ed));
  $viewgen=combine($app, 'Админка', $viewgen);
}
