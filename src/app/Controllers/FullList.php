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
$cat=$Pg->getPageCat($app['pdo'], $cat);
$viewgen=$app['twig']->render('fulllist.html', array('list' => $list, 'cat' => $cat));
$viewgen=combine($app, 'Каталог', $viewgen);
