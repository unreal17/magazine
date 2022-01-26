<?php
$errorLog = false;
$errorPass = false;
$errorName = false;
$errorNameResult = "";
$errorLoginResult = "";
if ($_POST['register']) {
    $mass = array();
    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
    $converter = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    );
    $pass = strtr($pass, $converter);
    $name = strtr($name, $converter);
    $login = strtr($login, $converter);
    $mass = array('login' => $login, 'name' => $name, 'pass' => $pass);

    if (isset($_POST['nobot'])) {
        if (mb_strlen($mass['login']) < 5 || mb_strlen($mass['login']) > 90) {
            $errorLog = true;
            $errorLoginResult = "Недопустимая длина логина... Необходимо длину больше 5 и меньше 90";
        } else if (mb_strlen($mass['name']) < 5) {
            $errorName = true;
            $errorNameResult = "Недопустимая длина имени... Необходимо длину больше 5";
        } else {
            $errorPass = $pass=="";
            if ($pass != "" && $login != "") {
                if (!BDConnection::Insert(new Usersreg(), $mass)) {
                    echo "<script>alert('Такой логин уже есть')</script>";
                }
                else{
                    echo '<script>location.replace("../login");</script>';
                }
            }
        }
    } else {
        echo "<script>alert('Проверка на бота не пройдена')</script>";
    }
}
?>
<div class="container">
    <div class="column">
        <h4 class="mb-3">Регистрация</h4>
        <form action="" method="post">
            <?if($errorLog) echo "<div>$errorLoginResult</div>";?>
            <input type="text" name="login" class="form-control" id="login" placeholder="Логин"
                   value="<? echo $_POST['login']; ?>"><br>
            <?if($errorName) echo "<div>$errorNameResult</div>";?>
            <input type="text" name="name" class="form-control" id="name" placeholder="Имя"
                   value="<? echo $_POST['name']; ?>"><br>
            <?if($errorPass) echo "<div>Пароль пуст</div>";?>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Пароль"><br>
            <input type="checkbox" name="nobot"> Я не робот<br>
            <br>
            <input type="submit" name="register" class="btn btn-success" value="Зарегистрироваться"><br>
            <a class="mt-3" href="/login">Перейти на авторизацию</a>
        </form>
    </div>
</div>
<script>
    document.title = "Регистрация";
</script>