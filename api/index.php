<?
session_start();
include_once 'db.php';
include_once 'newspaper.module.php';
include_once 'file.module.php';
include_once 'user.php';

try {
    if(
        isset($_POST['date']) &&
        isset($_POST['author_id']) &&
        isset($_POST['title'])
    ) {
        $date = $_POST['date'];
        $title = $_POST['title'];
        $author_id = intval($_POST['author_id']);
        createNewspaper($title, $date, $author_id);
        header('Location: /admin.php');
    }

    if(
        isset($_POST['newspaper_id']) &&
        isset($_FILES['newspaper_file'])
    ) {
        $newspaper_id = $_POST['newspaper_id'];
        $newspaper_file = $_FILES['newspaper_file'];
        
        // Проверка на успешную загрузку файла
        if ($uploadResult = uploadFile('newspaper_file')) {
            addNewspaperContent($uploadResult, $newspaper_id);
            header('Location: /gazeta.php?id='.$newspaper_id);
        } else {
            throw new Exception("Ошибка при загрузке файла.");
        }
    }
    if(
        isset($_POST['newspaper_text']) &&
        isset($_POST['newspaper_type']) &&
        isset($_POST['newspaper_id'])
    ) {
        $newspaper_id = $_POST['newspaper_id'];
        $newspaper_text = $_POST['newspaper_text'];
        $newspaper_type = $_POST['newspaper_type'];
        addNewspaperContentData($newspaper_text, $newspaper_id, $newspaper_type);
        header('Location: /gazeta.php?id='.$newspaper_id.'&scroll_down=1');
    }
    if(
        isset($_POST['name']) &&
        isset($_POST['surname'])
    ) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $id = registerUser($name, $surname);
        $_SESSION['user_id'] = $id;
        header('Location: /');
    }
    if(
        isset($_POST['newspaper_content_data_id']) &&
        isset($_POST['newtext']) &&
        isset($_POST['newspaper_id'])
    ) {
        $newspaper_content_data_id = intval($_POST['newspaper_content_data_id']);
        $newtext = $_POST['newtext'];
        $newspaper_id = intval($_POST['newspaper_id']);
        updateNewspaperContentData($newspaper_content_data_id, $newtext);
        header('Location: /gazeta.php?id='.$newspaper_id.'&scroll_down=1');
    }
}catch(Exception $e) {
    header('Location: /admin.php?error='.$e->getMessage());
}

?>