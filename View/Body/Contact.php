<?
$errorEMP = false;
if ($_POST['submit']) {
    if (empty($_POST['name']) || empty($_POST['mail']) || empty($_POST['phone']) || empty($_POST['text'])) {
    $errorEMP = true;
    } else {
        $mass = array(
            'name' => htmlspecialchars($_POST['name']),
            'mail' => htmlspecialchars($_POST['mail']),
            'phone' => htmlspecialchars($_POST['phone']),
            'text' => htmlspecialchars($_POST['text']),
        );

        $result = BDConnection::Insert($comment, $mass);
        if ($result == true) {
            echo "<script>alert('отправлено')</script>";
            echo '<script>location.replace("../contact");</script>';
        } else {
            echo "<script>alert('произошла ошибка')</script>";
            echo '<script>location.replace("../contact");</script>';
        }
    }
}
?>
<div class="bodyer">
    <div class="content">
        <div class="line"></div>
        <h2>Свяжитесь с нами, чтобы получать новые эксклюзивы</h2>
        <div class="content_blockOne">
            <div class="form">
                <form class="forms" action="" method="post">
                    <div class="form-inner">
                        <? if ($errorEMP) echo "<div>Не все поля заполненны</div>"; ?>
                        <input type="username" placeholder="Имя" name="name" id="name">
                        <input type="email" placeholder="Почта" name="mail" id="mail">
                        <input type="number" placeholder="Телефон" name="phone" id="phone">
                        <textarea placeholder="Сообщение..." rows="3" name="text" id="text"></textarea>
                        <input type="submit" name="submit" value="Отправить">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    document.title = "Контакты";
</script>