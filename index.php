<?php
include("db.php");
include("header.php");
?>


<div class="flex-container">
    <div class="category">
        <b>Категория</b>
        <form action="/" method="post">
        <?php
        $cat = $pdo->query('SELECT * FROM category');
        $categories = $cat->fetchAll();
        foreach ($categories as $category) {
            echo "<label>$category[name]
                <input type=\"checkbox\" class=\"checkbox\" name='category[]' value='$category[id]'>
                <span class=\"checkbox-indicator\"></span>
            </label>";
        }

        ?>
            <button name="search_categorie">Найти</button>
        </form>
    </div>
    <div class="post-wrap">
        <?php
        $smtp = $pdo->query('SELECT * FROM post');
        $posts = $smtp->fetchAll();

        foreach ($posts as $post){
            $smtp = $pdo->query("SELECT category.name FROM category INNER JOIN post_category ON category.id = post_category.category_id WHERE post_category.post_id = $post[id];)");
            $categories = $smtp->fetchAll();
            echo "<div class='post clear-fix'>
            <h2>$post[title]</h2>
            <p>$post[data]</p><br>
            
            <img src='/postImage/$post[img]' alt=''>
            <p class='anotation'>$post[anotation]</p>";
            if(count($categories)>0){
                $str = "";
                echo "<span>Категории: ";
                foreach($categories as $categ){
                    $str.= "$categ[name], ";
                }
                $str = substr($str, 0, -2);
                echo $str;
                echo "</span>";
            }
            echo "<a href='post.php?id=$post[id]' class='btn'>Подробнее</a>
        </div>";
        }

        ?>

<!--        <div class="post">-->
<!--            <h2>Идеальный питомец для ребёнка.</h2>-->
<!--            <img src="/img/12_2-750x362.jpg" alt="">-->
<!--            <p>Представьте на минутку, как, вернувшись с работы, находите квартиру в полном хаосе: вещи разбросаны, стул валяется на полу, а из-за стоящего в углу кресла раздаётся пронзительный визг. Причиной возникновения подобной ситуации в вашем доме может стать неверный выбор домашнего питомца. Чтобы избежать этих и других возможных проблем, стоит кое-что учесть.</p>-->
<!--            <a href="" class="btn">Подробнее</a>-->
<!--        </div>-->
<!--        <div class="post">-->
<!--            <h2>Хомяк сбежал: что делать?</h2>-->
<!--            <img src="/img/146951562416.jpg" alt="">-->
<!--            <p>Многие любят хомячков и с удовольствием ухаживают за ними. Но есть у этих питомцев особая черта: если хомяк может сбежать из клетки - хомяк непременно сбежит! Если это произошло и с Вашим любимым хомячком, постарайтесь его разыскать и вернуть. Для этого есть целый ряд полезных приемов.</p>-->
<!--            <a href="" class="btn">Подробнее</a>-->
<!--        </div>-->
        <div class="pagination">
            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
            <img src="img/Фигура%203.png" class="next">
        </div>
    </div>
</div>
<?php
include ("footer.php");
?>

</body>
</html>