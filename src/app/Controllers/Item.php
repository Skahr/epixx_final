<?php
$Pg= new Models\ShowList();
$list=$Pg->getItem($app['pdo'], $id);
$viewgen=$app['twig']->render('item.html', array('list' => $list));
$viewgen=combine($app, $list[0]['name'], $viewgen);
