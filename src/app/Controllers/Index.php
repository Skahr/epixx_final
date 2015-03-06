<?php
namespace Controllers;

use Silex\Application;
use Silex\Route;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class Index implements ControllerProviderInterface {

    public function connect(Application $app) {
      $factory= $app['controllers_factory'];
      $factory->get('/', 'Controllers\Index::getWelcome');
      $factory->get('/products', 'Controllers\Index::getFullList');


      return $factory;
    }
    public function getWelcome(Application $app) {
      require_once 'src/app/Controllers/Welcome.php';
      return $viewgen;
    }
    public function getFullList(Application $app) {
      require_once 'src/app/Controllers/FullList.php';
      return $viewgen;
    }
    public function getDelivery(Application $app) {
      require_once 'src/app/Controllers/Delivery.php';
      return $viewgen;
    }
    public function getContacts(Application $app) {
      require_once 'src/app/Controllers/Contacts.php';
      return $viewgen;
    }
}
