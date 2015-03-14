<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
use Herrera\Pdo\PdoServiceProvider;
use Silex\Application;
$app= new Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/app/Views'
));
$app->register(new PdoServiceProvider(),
  array(
    'pdo.dsn' => 'mysql:dbname=epixx_final;host=127.0.0.1',
    'pdo.username' => 'root',
    'pdo.password' => '',
    'pdo.options' => array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
    )
  )
);

$app['debug']=true;  //закомментить
$app->get('/', function() use ($app){
  require_once '/app/Controllers/Welcome.php';
  return $viewgen;
})->bind('homepage');
$app->get('/shortlist/{id}', function($id) use ($app){
  if(isset($_SESSION['login'])) {
    require_once '/app/Controllers/ShortList.php';
    return $viewgen;
  }
  else {
    return $app->redirect($app['url_generator']->generate('user'));
  }
})->bind('shortlist');

$app->get('/user', function() use ($app){
  if(isset($_SESSION['login'])) {
    require_once '/app/Controllers/Admin.php';
  }
  else {
    require_once '/app/Controllers/Login.php';
  }
  return $viewgen;
})->bind('user');
$app->post('/user', function() use ($app){
  if(isset($_SESSION['login'])) {
    require_once '/app/Controllers/Admin.php';
  }
  else {
    require_once '/app/Controllers/Login.php';
  }
  return $app->redirect($app['request']->getUri());
});
$app->get('/user/{id}', function($id) use ($app){
  if(isset($_SESSION['login'])) {
    require_once '/app/Controllers/AdmOrderId.php';
    return $viewgen;
  }
  else {
    return $app->redirect($app['url_generator']->generate('user'));
  }
});
$app->post('/user/{id}', function($id) use ($app){
  require_once '/app/Controllers/AdmOrderId.php';
  return $app->redirect($app['request']->getUri());
});
$app->get('/cart', function() use ($app) {
  require_once '/app/Controllers/Cart.php';
  return $viewgen;
})->bind('cart');
$app->post('/cart', function() use ($app) {
  if (isset($_POST['buy'])) {
    require_once '/app/Controllers/Buy.php';
    return $app->redirect($app['url_generator']->generate('thanks'));
  }
  else {
    require_once '/app/Controllers/Cart.php';
    return $app->redirect($app['request']->getUri());
  }
});
$app->get('/thanks', function() use ($app){
  require_once '/app/Controllers/Thanks.php';
  return $viewgen;
})->bind('thanks');

$app->mount('/products', new Controllers\Products());
$app->run();

function combine($app, $title, $viewgen){  //сбор страницы; к хедеру + $title, вставка $fname основного контента
  //isset($_SESSION['cart']) ? $session=$_SESSION['cart'] : $session='';
  isset($_SESSION['cart']) ? require_once '/app/Controllers/MiniCart.php' : $session='';
  return $app['twig']->render('header.html', array('title' => $title)).
  $viewgen.$app['twig']->render('sidebar.html', array('session' => $session)).$app['twig']->render('footer.html');
}
