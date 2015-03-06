<?php
$Pg= new Models\ShowList();
$list=$Pg->getFullList($app['pdo']);
$viewgen=$app['twig']->render('fulllist.html', array('list' => $list));
$viewgen=combine($app, 'Каталог', $viewgen);
