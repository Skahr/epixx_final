<?php
if (isset($_POST['logout'])) {
  unset($_SESSION['login']);
  unset($_SESSION['ed_mode']);
}
elseif (isset($_POST['changepass'])) {
  if($_POST['password_new_1']==$_POST['password_new_2']){
    $Pg= new Models\UserList();
    $rows=$Pg->checkPassword($app['pdo'], $_SESSION['login']);
    if($rows) {
      if (password_verify($_POST['password_old'], $rows[0]['password'])){
        $Pg->changePassword($app['pdo'], $rows[0]['id'], password_hash($_POST['password_new_1'], PASSWORD_DEFAULT));
        setflash('Пароль изменен', 'green');
      }
      else {
        setflash('Старый пароль не подходит');
      }
    }
    else {
      setflash('Не могу найти '.$_SESSION['login'].' в базе');
    }
  }
  else {
    setflash('Новые пароли не совпадают');
  }
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
