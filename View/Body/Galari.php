<div class="bodyer">
    <br>
    <div class="titleGaleri"><h2>Галерея</h2></div>
    <br>
    <div class="row"><h3>
        <?
        if(!isset($_COOKIE["usersreg"])){
            echo("Галерею могут просматривать только авторизированные пользователи...");
        }
        else {
            $result = BDConnection::SelectAll($images);
            if ($result) {
                while ($last = $result->fetch_assoc()) {
                    echo '<a href='.$last['dir'].$last['name_photo'].' onclick="return hs.expand(this)"><img src='.$last['dir'].$last['name_photo'].' class="img"></a>';
                }

                $result->close();
            }
            if ($_COOKIE['Admin'] == 1){
                echo '<a href="/AddPhoto"><div class="add-photo"><img class="addForm" src="./images/icons/add.svg" alt=""></div></a>';
            }
        }
        ?>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.wrapperClassName = 'wide-border';
    document.title = "Галерея";
</script>