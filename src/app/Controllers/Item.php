<?php
$Pg= new Models\ShowList();
if(isset($_POST['pic_up'])) {
  $target_dir = "../web/img/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  }
  else {
    setflash('Файл не является картинкой');
    $uploadOk = 0;
  }
  if($imageFileType != "png") {
    setflash('Картинка должна быть только в PNG-формате');
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    $_SESSION['flash']='Ваш файл не загружен: '.$_SESSION['flash'];
  }
  else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $img=rtrim(basename($_FILES["fileToUpload"]["name"]), '.png');
      $Pg->postPicToDb($app['pdo'], $id, $img);
      setflash('Картинка загружена и добвалена в базу', 'green');
    }
    else {
      setflash('Ошибка загрузки файла');
    }
  }
}
elseif(isset($_POST['item_ed'])) {
  $Pg->postItemToDbUpdate($app['pdo'], $id, $_POST['name'], $_POST['description'], $_POST['img'], $_POST['price'], $_POST['sale'], $_POST['units'], $_POST['q'], $_POST['soldq']);
}
else {
  $list=$Pg->getItem($app['pdo'], $id);
  if(isset($_SESSION['ed_mode'])) {
    $viewgen=$app['twig']->render('item_ed.html', array('list' => $list));
  }
  else {
    $viewgen=$app['twig']->render('item.html', array('list' => $list));
  }

  if($list) {
    $viewgen=combine($app, $list[0]['name'], $viewgen);
  }
  else {
      $viewgen=combine($app, 'Ошибка', $viewgen);
  }
}