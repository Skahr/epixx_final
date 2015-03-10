<?php
namespace Controllers;

use Silex\Application;
use Silex\Route;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class Products implements ControllerProviderInterface {

    public function connect(Application $app) {
      $factory= $app['controllers_factory'];
      $factory->get('/', 'Controllers\Products::getFullList')->bind('products');
      $factory->get('/category', 'Controllers\Products::getByCategory');
      $factory->get('/{id}', 'Controllers\Products::getItemPage');
      $factory->post('/{id}', 'Controllers\Products::postToCart');
      $factory->post('/', 'Controllers\Products::postToCart');
      return $factory;
    }
    public function getFullList(Application $app) {
      require_once 'src/app/Controllers/FullList.php';
      return $viewgen;
    }
    public function getItemPage(Application $app, $id) {
      require_once 'src/app/Controllers/Item.php';
      return $viewgen;
    }
    public function getByCategory(Application $app) {
      require_once 'src/app/Controllers/FullList.php';
      return $viewgen;
    }
    public function postToCart(Application $app, $id=0) {
      if (isset($_POST['tocart'])){
        if(isset($_POST['id'])) {
          $id=$_POST['id'];
        }
        $_SESSION['cart'][$id]++;
      }
      return $app->redirect($app['request']->getUri());
    }
}
