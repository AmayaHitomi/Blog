<?php
    include("db.php");
    include("header.php");

    if(isset($_POST["add_post"])){
        $image = $_FILES[img];
        $name = $image[name];

        $_POST['img'] = $name;
        $allowed = array("title","img","anotation","text","author","data"); // allowed fields
        $values = array();
        $sql = "INSERT INTO post SET ".pdoSet($allowed,$values);
        $stm = $pdo->prepare($sql);
        $stm->execute($values);

        $target_dir = "postImage/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

        $_POST['post_id'] = $pdo->lastInsertId();
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        foreach ($_POST['category'] as $item){
            $_POST['category_id'] = $item;
            $allowed = array("post_id","category_id"); // allowed fields
            $sql = "INSERT INTO post_category SET ".pdoSet($allowed,$values);
            $stm = $pdo->prepare($sql);
            $stm->execute($values);
        }

    }
    $cat = $pdo->query('SELECT * FROM category');
    $categories = $cat->fetchAll();

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="addpost">
    <form enctype="multipart/form-data"  method="post" name="New post">
        <input type="text" name="title" placeholder="Название статьи">
        <input type="file" name="img" placeholder="Изображение">
        <input type="text" name="anotation" placeholder="Анотация">
        <textarea name="text" placeholder="Текст статьи"></textarea>
        <input type="text" name="author" placeholder="Автор">
        <input type="date" name="data" placeholder="Дата"><br>
        <select class="select" name="category[]" multiple>
            <?php
            foreach ($categories as $item) {
               echo "<option value='$item[id]'>$item[name]</option>";
            }
            ?>

        </select>
        <button class="btn" type="submit" name="add_post">Отправить</button>
    </form>
</div>
<?php
include ("footer.php");
?>
</body>
</html>


