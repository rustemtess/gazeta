<?
session_start();
include_once 'api/db.php';
include_once 'api/newspaper.module.php';

if(isset($_POST['search'])) {
    $arr = [];
    $text = $_POST['search_text'];
    $arr = searchNewspaperByText($text);
}else {
    $arr = [];
    $arr = getNewspaperMainList();
}

if(isset($_POST['auth'])) {
    $accountId = intval($_POST['account_id']);
    $_SESSION['user_id'] = $accountId;
    header('Location: /admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center p-2">
    <div class="w-full max-w-[1200px] flex flex-col">
        <header class="flex items-center justify-between">
            <h1 class="text-xl">Газета</h1>
            <a class="bg-black rounded p-2 text-white" href="/">Назад</a>
        </header>
        <main class="flex justify-center pt-5">
            <form class="flex flex-col gap-2 w-full max-w-[600px]" method="post" action="/api/index.php" enctype="multipart/form-data">
                <input class="bg-gray-100 rounded p-2 outline-none" name="name" placeholder="Имя" />
                <input class="bg-gray-100 rounded p-2 outline-none" name="surname" placeholder="Фамилия" />
                <button class="bg-black text-white rounded p-2" type="submit" name="submit">Создать аккаунт</button>
            </form>
        </main>
        <main class="flex justify-center pt-5">
            <form class="flex flex-col gap-2 w-full max-w-[600px]" method="post">
                <input class="bg-gray-100 rounded p-2 outline-none" name="account_id" placeholder="ID аккаунта" />
                <button class="bg-black text-white rounded p-2" type="submit" name="auth">Вход</button>
            </form>
        </main>
        <div>
            <?
                $users = $db->query("SELECT * FROM `users`")->fetch_all(MYSQLI_ASSOC);
                foreach($users as $user) {
                    ?>
                        <p><?=$user['user_id']." - ".$user['user_surname']." ".$user['user_name']?></p>
                    <?
                }
            ?>
        </div>
    </div>
</body>
</html>