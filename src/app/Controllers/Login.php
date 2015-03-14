<?php
if(isset($_POST['login'])) {

  //проверки логин/пароль
  $_SESSION['login']=$_POST['email'];
}
else {
  $viewgen=$app['twig']->render('login.html', array());
  $viewgen=combine($app, 'Вход', $viewgen);

}
