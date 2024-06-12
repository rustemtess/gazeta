<?

include_once 'api/db.php';
include_once 'api/newspaper.module.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center p-4">
    <div class="w-full max-w-[1200px] flex flex-col items-center">
        <header class="flex items-center justify-between w-full">
            <h1 class="text-xl">Админ панель</h1>
            <a class="bg-black rounded p-2 text-white" href="/">Назад</a>
        </header>
        <div class="flex gap-4 justify-around w-full">
            <div class="w-full flex flex-col max-w-[200px]">
                <h1>ID моих газет:</h1>
                <?
                    foreach(getMyNewspaper(1) as $news) {
                        ?>
                            <a href="/gazeta.php?id=<?=$news['newspaper_id']?>" class="text-lg underline">Перейти по ID: <span class="font-medium"><?=$news['newspaper_id']?></span></a>
                        <?
                    }
                ?>
            </div>
            <div class="flex flex-col gap-5 w-full max-w-[600px]">
                <?

                if(isset($_GET['error'])) {
                    ?>
                        <h4 class="bg-red-500 text-white rounded p-2"><?=$_GET['error']?></h4>
                    <?
                }

                ?>
                <h3>Новая газета</h3>
                <form class="flex flex-col gap-2" method="post" action="/api/index.php" enctype="multipart/form-data">
                    <input class="bg-gray-100 rounded p-2 outline-none" name="title" placeholder="Название газеты" />
                    <input class="bg-gray-100 rounded p-2 outline-none" name="date" type="date" />
                    <input name="author_id" hidden value="1" />
                    <button class="bg-black text-white rounded p-2" type="submit" name="submit">Создать газету</button>
                </form>
                <h3>Загрузить фотографию</h3>
                <form class="flex flex-col gap-2" method="post" action="/api/index.php" enctype="multipart/form-data">
                    <input class="bg-gray-100 rounded p-2 outline-none" name="newspaper_id" type="number" placeholder="Введите ID газеты" />
                    <input class="bg-gray-100 rounded p-2 outline-none" type="file" name="newspaper_file">
                    <button class="bg-black text-white rounded p-2" type="submit" name="submit">Загрузить изображение</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>