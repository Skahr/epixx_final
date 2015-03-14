<?php
$rows_id='';
$session=array(0, 0);
foreach($_SESSION['cart'] as $k => $v) {
  $rows_id.=$k.', ';
  $session['0']+=$v;
}
$Pg= new Models\ShowList();
$rows=$Pg->getCartList($app['pdo'], trim($rows_id,', '));
//$price='0';
foreach($rows as $i => $v) {
  $session['1']+=($rows[$i]['price']*(1-$rows[$i]['sale']/100))*$_SESSION['cart'][$rows[$i]['id']];
}
