<?php
$Pg= new Models\ShowList();
$list=$Pg->getFullList($app['pdo']);
$viewgen=$app['twig']->render('short_list.html', array('list' => $list, 'o_id' => $id));
$viewgen=combine($app, 'Добавить', $viewgen);
