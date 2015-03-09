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
    // public function getWelcome(Application $app) {
    //   require_once 'src/app/Controllers/Welcome.php';
    //   return $viewgen;
    // }
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
        $_SESSION['cart'][]=array($id => $_POST['quantity']);

      }
      if (isset($_POST['clearcart'])) {
        unset($_SESSION['cart']);

      }
      //header('Location: /');
      //require_once 'src/app/Controllers/Cart.php';
      //$viewgen=combine($app, 'Каталог', $viewgen);
      //require_once 'src/app/Controllers/FullList.php';
      return $app->redirect($app['request']->getUri());
    }
    // public function getDelivery(Application $app) {
    //   require_once 'src/app/Controllers/Delivery.php';
    //   return $viewgen;
    // }
    // public function getContacts(Application $app) {
    //   require_once 'src/app/Controllers/Contacts.php';
    //   return $viewgen;
    // }
}
