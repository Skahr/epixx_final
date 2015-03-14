<?php
$order=json_encode($_SESSION['cart']);
$Pg= new Models\OrderList();
$Pg->postOrder($app['pdo'], $order, $_POST['c_name'], $_POST['c_phone']);

unset($_SESSION['order']);
unset($_SESSION['cart']);
//обработать уменьшение кол-ва в бд и запись заказа в бд
