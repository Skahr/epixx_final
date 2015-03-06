<?php
require_once __DIR__.'/src/vendor/autoload.php';
use Herrera\Pdo\PdoServiceProvider;
use Silex\Application;
$app= new Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/src/app/Views'
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

$app['debug']=true;
// $app->get('/', function(){
//   require_once 'src/app/Controllers/Welcome.php';
//   return $viewgen;
// });
$app->mount('/', new Controllers\Index());
$app->mount('/products', new Controllers\Index());
$app->run();
function combine($app, $title, $viewgen){  //сбор страницы; к хедеру + $title, вставка $fname основного контента
  return $app['twig']->render('header.php', array('title' => $title)).
  $viewgen.$app['twig']->render('footer.php');
}
