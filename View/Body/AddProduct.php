<?php
if (isset($_POST['submit'])) {
    $uploadFile = UploadFile::Upload($DIR, 'product');
    if (gettype($uploadFile) == "array") {
        print_r($uploadFile);
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $cost = htmlspecialchars($_POST['cost']);
        $massdan = array('name' => $name, 'description' => $description, 'image_name' => $uploadFile['name'], 'image_past' => $uploadFile['path'], 'cost' => $cost);
        $result = BDConnection::Insert($goods, $massdan);
        if ($result == true) {
            echo '<script>location.replace("/goods");</script>';
        }
    } else {
        echo $uploadFile;
    }
}

?>
<div class="wrapper">
    <div class="load form">
        <form class="form" method="POST" enctype="multipart/form-data">
            <p>Загрузи фото товара</p>
            <input class="input" type="file" name="file" id="inputfile">
            <p>Напишите название товара</p>
            <input class="input" type="text" name="name" value="<? echo $_POST['name']; ?>">
            <p>Напишите описание товара</p>
            <textarea id="input_text" class="input" name="description" value=""><? echo $_POST['description']; ?></textarea>
            <p>Напишите стоимость товара</p>
            <input class="input" type="number" name="cost" value="<? echo $_POST['cost']; ?>">
            <input id="submit" class="input" type="submit" name="submit" value="Upload">
            <a href="/galari">
                <div class="buttonBack">К галерее</div>
            </a>
        </form>

    </div>
</div>
