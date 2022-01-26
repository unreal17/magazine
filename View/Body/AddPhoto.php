<?php
if (isset($_POST['submit'])) {
    $uploadFile = UploadFile::Upload($DIR, 'picture');
    if (gettype($uploadFile) == "array") {
        $fio = Converter::Convert($_POST['fio']);
        $text = htmlspecialchars($_POST['text']);
        $massdan = array();
        $massdan = array('fio' => $fio, 'text' => $text, 'name_photo' => $uploadFile['name'], 'dir' => $uploadFile['path']);
        $result = BDConnection::Insert($images, $massdan);
        if ($result == true) {
            echo '<script>location.replace("/galari");</script>';
        }
    } else {
        echo '<script>alert(' . $uploadFile . ');</script>';
    }
}

?>
<div class="wrapper">
    <div class="load form">
        <form class="form" method="POST" enctype="multipart/form-data">
            <p>Загрузи фото</p>
            <input class="input" type="file" name="file" id="inputfile">
            <p>Напиши ваше имя</p>
            <input class="input" type="text" name="fio" value="">
            <p>Пару слов о фото</p>
            <textarea id="input_text" class="input" name="text" value=""></textarea>

            <input id="submit" class="input" type="submit" name="submit" value="Upload">
            <a href="/galari">
                <div class="buttonBack">К галерее</div>
            </a>
        </form>
    </div>
</div>
