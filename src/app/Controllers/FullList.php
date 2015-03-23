<?php
$Pg= new Models\ShowList();

if(isset($cat)) {
  $list=$Pg->getByCategory($app['pdo'], $cat);
}
else {
  $list=$Pg->getFullList($app['pdo']);
}
$viewgen=$app['twig']->render('fulllist.html', array('list' => $list));
$viewgen=combine($app, 'Каталог', $viewgen);
