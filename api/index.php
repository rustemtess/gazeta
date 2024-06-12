<?

include_once 'db.php';
include_once 'newspaper.module.php';
include_once 'file.module.php';

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
            header('Location: /admin.php');
        } else {
            throw new Exception("Ошибка при загрузке файла.");
        }
    }
    if(
        isset($_POST['newspaper_text']) &&
        isset($_POST['newspaper_id'])
    ) {
        $newspaper_id = $_POST['newspaper_id'];
        $newspaper_text = $_POST['newspaper_text'];
        addNewspaperContentData($newspaper_text, $newspaper_id);
        header('Location: /gazeta.php?id='.$newspaper_id);
    }
}catch(Exception $e) {
    header('Location: /admin.php?error='.$e->getMessage());
}

?>