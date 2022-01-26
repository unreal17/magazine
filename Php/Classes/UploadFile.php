<?php

class UploadFile
{
    public static function Upload(string $dir, string $folder)
    {
        $input_name = 'file';

        // Разрешенные расширения файлов.
        $allow = array();

        // Запрещенные расширения файлов.
        $deny = array(
            'phtml', 'Php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
        );
        // Директория куда будут загружаться файлы.
        $path_bd = './images/' . $folder . '/';
        $path = $dir . '/images/' . $folder . '/';
        if (isset($_FILES[$input_name])) {
            // Проверим директорию для загрузки.
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0) {
                $files = array($_FILES[$input_name]);
            } else {
                foreach ($_FILES[$input_name] as $k => $l) {
                    foreach ($l as $i => $v) {
                        $files[$i][$k] = $v;
                    }
                }
            }

            foreach ($files as $file) {
                $error = $success = '';

                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name'])) {
                    switch (@$file['error']) {
                        case 0:
                            break;
                        case 1:
                            $error = 'Размер принятого файла превысил максимально допустимый размер';
                            break;
                        case 2:
                            $error = 'Превышен размер загружаемого файла.';
                            break;
                        case 3:
                            $error = 'Файл был получен только частично.';
                            break;
                        case 4:
                            $error = 'Файл не был загружен.';
                            break;
                        case 6:
                            $error = 'Файл не загружен - отсутствует временная директория.';
                            break;
                        case 7:
                            $error = 'Не удалось записать файл на диск.';
                            break;
                        case 8:
                            $error = 'PHP-расширение остановило загрузку файла.';
                            break;
                        case 9:
                            $error = 'Файл не был загружен - директория не существует.';
                            break;
                        case 10:
                            $error = 'Превышен максимально допустимый размер файла.';
                            break;
                        case 11:
                            $error = 'Данный тип файла запрещен.';
                            break;
                        case 12:
                            $error = 'Ошибка при копировании файла.';
                            break;
                        default:
                            $error = 'Файл не был загружен - неизвестная ошибка.';
                            break;
                    }
                } elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
                    $error = 'Не удалось загрузить файл.';
                } else {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
                    $name = mb_eregi_replace($pattern, '-', $file['name']);
                    $name = mb_ereg_replace('[-]+', '-', $name);

                    // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                    // Сделаем их транслит:

                    $name = Converter::Convert($name);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension'])) {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        // Чтобы не затереть файл с таким же названием, добавим префикс.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];

                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            $result = array('path' => $path_bd,
                                'name' => $name);
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                        if ($error == '')
                            return $result;
                    }
                }
            }
        }
        return $error;
    }
}