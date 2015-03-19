<?php
if(isset($_POST['login'])) {
  $Pg= new Models\UserList();
  $rows=$Pg->checkPassword($app['pdo'], $_POST['email']);
  if($rows) {
    if (password_verify($_POST['password'], $rows[0]['password'])){
      $_SESSION['login']=$_POST['email'];
    }
    else {
      //setflash(password_hash($_POST['password'], PASSWORD_DEFAULT));
      setflash('Такой комбинации логин/пароль не существует');
    }
  }
  else {
    setflash('Нет такого пользователя');
  }
}
else {
  $viewgen=$app['twig']->render('login.html', array());
  $viewgen=combine($app, 'Вход', $viewgen);

}
