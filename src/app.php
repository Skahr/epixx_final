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
    if (isset($_SESSION['shortlist'])){
      require_once '/app/Controllers/ShortList.php';
    }
    else {
      require_once '/app/Controllers/AdmOrderId.php';
    }
    return $viewgen;
  }
  else {
    return $app->redirect($app['url_generator']->generate('user'));
  }
});
$app->post('/user/{id}', function($id) use ($app){
  if (isset($_POST['shortlist'])){
    $_SESSION['shortlist']='1';
  }
  else {
    require_once '/app/Controllers/AdmOrderId.php';
  }
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
$app->get('/add', function() use ($app){
  if(isset($_SESSION['login'])) {
    require_once '/app/Controllers/Add.php';
    return $viewgen;
  }
  else {
    $app->abort(404, "Something is wrong");
  }
})->bind('add');
$app->post('/add', function() use ($app){
  require_once '/app/Controllers/Add.php';
  return $app->redirect($app['request']->getUri());
});
$app->mount('/products', new Controllers\Products());
$app->run();

function combine($app, $title, $viewgen){  //сбор страницы; к хедеру + $title, вставка $fname основного контента
  isset($_SESSION['cart']) ? require_once '/app/Controllers/MiniCart.php' : $session='';
  isset($_SESSION['flash']) ? $flash=$_SESSION['flash'] : $flash='';
  isset($_SESSION['flash_color']) ? $f_color=$_SESSION['flash_color'] : $f_color='white';
  unset($_SESSION['flash']);
  unset($_SESSION['flash_color']);
  $Pg= new Models\ShowList();
  $list=$Pg->getCatLinks($app['pdo']);
  return $app['twig']->render('header.html', array('title' => $title, 'flash' => $flash, 'f_color' => $f_color, 'list' => $list)).
  $viewgen.$app['twig']->render('sidebar.html', array('session' => $session)).$app['twig']->render('footer.html');
}
function setflash($str, $color='red') {
  $_SESSION['flash']=$str;
  if ($color=='red'){
    $_SESSION['flash_color']='red';
  }
  else {
    $_SESSION['flash_color']='green';
  }
}
