<?php
if ($_POST['Delete']) {
    $_SESSION['cart'] = $cart->SetCountItems($_POST['id'], 0);
}
?>
<div class="cart">
    <div class="container">
        <div class="column">
            <li class="inline">
                <ul>Название</ul>
                <ul>Стоимость</ul>
                <ul>Количество</ul>
                <ul>Сумма</ul>
                <ul>Удалить</ul>
            </li>
            <? foreach ($cart->getItems() as $key => $value) { ?>
                <?
                $result = BDConnection::SelectById($goods, $key);
                //print_r( $result->fetch_assoc());
                $item = $result->fetch_assoc();
                ?>

                <form class="form" method="POST">
                    <div class="item inline">

                        <p><? echo $item['name']; ?></p>


                        <p><? echo $item['cost']; ?>р</p>
                        <p><? echo $value; ?></p>
                        <p><? echo $item['cost'] * $value; ?>р</p>

                        <input type="text" name="id" value="<? echo $item['ID'] ?>" hidden>
                        <input type="submit" name="Delete" value="Удалить">
                    </div>
                </form>
                <br>

            <? } ?>
            <br>
            <br>
            <br>
            <div class="float">
                <input type="text" name="id" value="<? echo $item['ID'] ?>" hidden>
                <input type="submit" name="Delete" value="Оформить заказ">
            </div>
        </div>
    </div>
</div>
<script>
    document.title = "Корзина";
</script>