<?php
if ($_POST['submit']) {
    $_SESSION['cart'] = $cart->AddOneItems($_POST['id']);
}
?>
<div class="bodyer">
    <div class="titleGaleri"><h3>Товары</h3></div>

    <div class="column">

        <?
        $result = BDConnection::SelectAll($goods);
        if ($result) {
            while ($last = $result->fetch_assoc()) { ?>
                <div class='row'>
                    <a href='<? echo $last['image_past'] . $last['image_name']; ?>'
                       onclick="return hs.expand(this)"><img src='<? echo $last['image_past'] . $last['image_name']; ?>'
                                                             class="img"></a>
                    <div class="column">
                        <li class="inline">
                            <ul>Название:</ul>
                            <ul>Стоимость за единицу:</ul>
                        </li>
                        <div class="inline">
                            <div class='product_name'><? echo $last['name']; ?></div>

                            <div class='cost'><? echo $last['cost']; ?>р</div>
                        </div>

                    </div>
                    <?if(isset($_COOKIE["usersreg"])){echo('
                    <form class="form" method="POST">
                        <input type="text" name="id" value="'.$last['ID'].'" hidden>
                        <input type="submit" name="submit" value="в корзину">
                    </form>
                    ');}?>
                </div>
                <?
            }

            $result->close();
        }
        if ($_COOKIE['Admin'] == 1) {
            echo '<a href="/AddProduct"><div class="add-photo"><img class="addForm" src="./images/icons/add.svg" alt=""></div></a>';
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="highslide/highslide.js"></script>
<script>
    hs.graphicsDir = 'highslide/graphics/';
    hs.wrapperClassName = 'wide-border';
    document.title = "Товары";
</script>