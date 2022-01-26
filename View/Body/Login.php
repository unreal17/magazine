<?php
$errorLog = false;
if ($_POST['LoginBtn']) {
    $mass = array();
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $login = Converter::Convert($login);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    $pass = Converter::Convert($pass);
    $mass = array('login' => $login, 'pass' => $pass);

    $result = BDConnection::SelectWhere($usersreg, "`login`='" . $mass['login'] . "' and `pass`='" . $mass['pass'] . "'");
    $user = mysqli_fetch_assoc($result);
    if ($user == null)
        $errorLog = true;
    else if ($user != null) {
        setcookie("usersreg", $user['login'], time() + 3600, "/");
        setcookie("Admin", $user['Admin'], time() + 3600, "/");
        echo '<script>location.replace("../");</script>';
    } else {
        echo "Что то другое";
    }
}
?>
<div class="container">
    <div class="column">
        <h4 class="mb-3">Авторизация</h4>
        <form action="" method="post">
            <input type="text" name="login" class="form-control" id="login" placeholder="Логин"><br>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
            <? if ($errorLog) echo "<div>Такой пользователь не найден...</div>"; ?>
            <input type="submit" class="btn btn-success" value="Авторизироваться" name="LoginBtn"><br>
            <br>
            <a class="mt-3" href="/registration">Перейти на регистрацию</a>
        </form>
    </div>
</div>
<script>
    document.title = "Вход";
</script>