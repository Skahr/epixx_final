<?php
namespace Controllers;

use Silex\Application;
use Silex\Route;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class Products implements ControllerProviderInterface {
    

    public function connect(Application $app) {
      $checkInt=function ($id) {
        return (int) $id;
      };
      $checkCat=function ($cat) {
        return $cat;
      };
      $factory= $app['controllers_factory'];
      $factory->get('/', 'Controllers\Products::getFullList')->bind('products');
      $factory->get('/{cat}', 'Controllers\Products::getByCategory');
      $factory->get('/{cat}/{id}', 'Controllers\Products::getItemPage')->convert('id', $checkInt);
      $factory->post('/{cat}/{id}', 'Controllers\Products::postToCart')->convert('id', $checkInt);
      $factory->post('/', 'Controllers\Products::postToCart');
      $factory->post('/{cat}', 'Controllers\Products::postToCart');
      return $factory;
    }
    public function getFullList(Application $app) {
      require_once '/../src/app/Controllers/FullList.php';
      return $viewgen;
    }
    public function getItemPage(Application $app, $id) {
      if(ctype_digit(strval($id))) {
        require_once '/../src/app/Controllers/Item.php';
        return $viewgen;
      }
      else {
        return $app->redirect($app['url_generator']->generate('products'));
      }
    }
    public function getByCategory(Application $app, $cat) {
      require_once '/../src/app/Controllers/FullList.php';
      return $viewgen;
    }
    public function postToCart(Application $app, $id=0) {
      if (isset($_POST['tocart'])){
        if(isset($_POST['id'])) {
          $id=$_POST['id'];
        }
        $_SESSION['cart'][$id]++;
      }
      elseif(isset($_POST['sort'])){
        if ($_POST['sort']=='clear'){
          unset($_SESSION['sort']);
        }
        else {
          $_SESSION['sort']=$_POST['sort'];
        }
      }
      else {
        require_once '/../src/app/Controllers/Item.php';
      }
      return $app->redirect($app['request']->getUri());
    }
}
