<?php
include("db.php");
include("header.php");

if(isset($_GET['id'])){
    $smtp = $pdo->prepare("UPDATE post SET views = views+1 WHERE id = :id");
    $smtp->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $smtp->execute();

}

?>




<div class="large_post">
<?php
$smtp = $pdo->query("SELECT * FROM post WHERE id = $_GET[id]");
$posts = $smtp->fetchAll();
foreach ($posts as $post){
    $smtp = $pdo->query("SELECT category.name FROM category INNER JOIN post_category ON category.id = post_category.category_id WHERE post_category.post_id = $post[id];)");
    $categories = $smtp->fetchAll();
    echo "<h1>$post[title]</h1>".
    "<img src='/postImage/$post[img]' alt=''>
    <pre><p>$post[text]</p></pre>
    <span>$post[data]</span>
    <span class='author'>Автор: <span>$post[author]</span></span><br>";
    if(count($categories)>0){
        $str = "";
                echo "<span class='post_category'>Категории: ";
                foreach($categories as $categ){
                    $str.= "$categ[name], ";
                }
                $str = substr($str, 0, -2);
                echo $str;
                echo "</span>";
    }
    echo "<span class='views'>Просмотры: $post[views]</span>";
}
?>  

</div>







<?php
include ("footer.php");
?>
</body>
</html>





