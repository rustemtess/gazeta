<?

function uploadFile($file) {
    $file_name = basename($_FILES[$file]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Проверка на тип файла
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        throw new Exception("Извините, только JPG, JPEG, PNG файлы могут быть загружены.");
        $uploadOk = 0;
    }
    
    // Генерация уникального имени файла
    $target_file = uniqid('', true) . '.' . $imageFileType;
    
    // Проверка на наличие ошибок при загрузке файла
    if ($uploadOk == 0) {
        throw new Exception("Извините, ваш файл не был загружен.");
    } else {
        if (move_uploaded_file($_FILES[$file]["tmp_name"], "uploads/".$target_file)) {
            return $target_file;
        } else {
            throw new Exception("Извините, произошла ошибка при загрузке файла.");
        }
    }
}



?>