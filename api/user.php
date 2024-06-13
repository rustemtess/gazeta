<?php

function registerUser(string $name, string $surname){
    global $db;
    if(trim($name) == null || trim($surname) == null) throw new Exception('Поля пустые');
    $query = $db->prepare(
        "INSERT INTO `users`(`user_name`, `user_surname`) VALUES (?,?)"
    );
    $query->bind_param('ss', $name, $surname);
    $query->execute();
    return $query->insert_id;
}

function getAuthorById(int $id) {
    global $db;
    $user = $db->query("SELECT * FROM `users` WHERE `user_id` = $id")->fetch_assoc();
    return $user['user_surname'].' '.$user['user_name'];
}

?>