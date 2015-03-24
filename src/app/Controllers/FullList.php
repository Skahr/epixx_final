<?php
$Pg= new Models\ShowList();
$sort='';
if(isset($_SESSION['sort'])) {
  $sort=$_SESSION['sort'];
}
if(!isset($cat)) {
  $cat='';
}
$list=$Pg->getFullList($app['pdo'], $cat, $sort);
$viewgen=$app['twig']->render('fulllist.html', array('list' => $list));
$viewgen=combine($app, 'Каталог', $viewgen);
