<?php
if(isset($_POST['addtodb'])){
  $name=trim($_POST['name']);
  $Pg= new Models\ShowList();
  $list=$Pg->checkName($app['pdo'], $name);
  if (!$list) {
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
        $img=basename($_FILES["fileToUpload"]["name"], '.png'); 
        $Pg->postItemToDb($app['pdo'], $name, $_POST['category'], $_POST['description'], $img, $_POST['price'], $_POST['sale'], $_POST['units'], $_POST['q']);
        setflash('Товар успешно добавлен в базу', 'green');
        
      }
      else {
        setflash('Ошибка загрузки файла');
      }
    }  
  }
  else {
    setflash('Товар с таким именем уже есть в базе');
  }
}
else {
  $viewgen=$app['twig']->render('add.html', array());
  $viewgen=combine($app, 'Добавить товар', $viewgen);
}
