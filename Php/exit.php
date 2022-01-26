<?php
setcookie('usersreg', $user[1], time() - 3600, "/");
setcookie("Admin",   $user[1], time() - 3600, "/");
header('Location: ../');

 ?>