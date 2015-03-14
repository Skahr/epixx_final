<?php
$viewgen=$app['twig']->render('thanks.html', array());
$viewgen=combine($app, 'Спасибо за покупку', $viewgen);
