<?php

function getNewspaperById(int $id = 0) {
    global $db;

    $query = $db->prepare("SELECT * FROM `newspapers`, `newspapers_content` WHERE newspapers.newspaper_id = ? AND newspapers_content.newspaper_id = newspapers.newspaper_id");
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();
    $result = $result->fetch_assoc();
    return $result;
}

function getNewspaperContentDataById(int $id = 0) {
    global $db;
    $query = $db->prepare("SELECT `newspaper_content_data_text` FROM `newspapers_content_data` WHERE newspaper_id = ?");
    $query->bind_param('i', $id);
    $query->execute();
    $result = $query->get_result();
    $result = $result->fetch_all();
    return $result;
}

function getNewspaperAll() : array {
    global $db;
    return $db->query("SELECT `newspaper_id` FROM `newspapers`")->fetch_all(MYSQLI_ASSOC);
}

function getNewspaperMainList() {
    global $db;
    return $db->query(
        "SELECT newspapers.newspaper_id, `newspaper_date`, `newspaper_title`, `newspaper_content_img` FROM `newspapers`, `newspapers_content` WHERE newspapers_content.newspaper_id = newspapers.newspaper_id"
    )->fetch_all(MYSQLI_ASSOC);
}

function searchNewspaperByText(string $text) : array {
    global $db;
    if(trim($text) == null) return getNewspaperMainList();
    // Преобразование текста к нижнему регистру
    $lowercase_text = strtolower($text);
    $query = $db->query(
        "SELECT newspapers.newspaper_id, `newspaper_date`, `newspaper_title`, `newspaper_content_img` 
        FROM `newspapers`, `newspapers_content`, `newspapers_content_data` 
        WHERE newspapers.newspaper_id = newspapers_content.newspaper_id 
        AND newspapers_content.newspaper_content_id = newspapers_content_data.newspaper_id 
        AND LOWER(newspapers_content_data.newspaper_content_data_text) LIKE '%$lowercase_text%'"
    )->fetch_all(MYSQLI_ASSOC);
    return $query;
}

function getMyNewspaper(int $authorId): array {
    global $db;
    return $db->query(
        "SELECT newspaper_id FROM `newspapers` WHERE newspapers_author_id = $authorId"
    )->fetch_all(MYSQLI_ASSOC);
}

function createNewspaper(string $title, string $date, int $authorId) {
    global $db;
    $query = $db->prepare("INSERT INTO `newspapers`(`newspaper_date`, `newspaper_title`, `newspapers_author_id`) VALUES (?,?)");
    $query->bind_param('ssi', $date, $title, $authorId);
    $query->execute();
}

function addNewspaperContent (string $fileUrl, int $newspaper_id){
    global $db;
    $query = $db->prepare("INSERT INTO `newspapers_content`(`newspaper_content_img`, `newspaper_id`) VALUES (?,?)");
    $query->bind_param('si', $fileUrl, $newspaper_id);
    $query->execute();
}

function addNewspaperContentData(string $newspaper_text, int $newspaper_id) {
    global $db;
    $query = $db->prepare("INSERT INTO `newspapers_content_data`(`newspaper_content_data_text`, `newspaper_id`) VALUES (?,?)");
    $query->bind_param('si', $newspaper_text, $newspaper_id);
    $query->execute();
}

?>