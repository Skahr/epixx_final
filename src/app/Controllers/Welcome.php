<?php
$Pg= new Models\ShowList();
$top_list=$Pg->getTopList($app['pdo']);
$sale_list=$Pg->getSaleList($app['pdo']);






$viewgen=$app['twig']->render('welcome.html', array(
  'top_list' => $top_list,
  'sale_list' => $sale_list
  )
);
$viewgen=combine($app, 'Лучшие игрушки и тд и тп', $viewgen);
