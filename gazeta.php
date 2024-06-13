<?php
session_start();
include_once 'api/db.php';
include_once 'api/newspaper.module.php';
include_once 'api/user.php';

try {
    if(isset($_GET['id'])) {
        $newspaper_id = intval($_GET['id']);
        $newspaper = getNewspaperById($newspaper_id);
        if(!$newspaper) throw new Exception('ID not found');
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="flex justify-center p-3">
            <div class="flex flex-col items-center w-full max-w-[1200px] gap-4">
                <header>
                    <a href="/" class="bg-black text-white p-2 rounded">Назад</a>
                </header>
                <img src="api/uploads/<?=$newspaper['newspaper_content_img']?>" width="300" />
                <p>Автор: <?=getAuthorById(intval($newspaper['newspapers_author_id']))?></p>
                <div class="indent-6 flex flex-col gap-1 w-full">
                    <?
                        foreach(getNewspaperContentDataById($newspaper_id) as $data) {
                            if(isset($_SESSION['user_id'])) {
                                if(trim($data[1]) !== '') {
                                    if($data[0] === 'title') {
                                        ?>
                                            <form method="POST" action="/api/index.php" class="flex gap-1 w-full">
                                                <input hidden name="newspaper_content_data_id" value="<?=$data[2]?>" />
                                                <input name="newspaper_id" hidden type="number" value="<?=$_GET['id']?>" />
                                                <textarea name="newtext" class="w-full text-lg font-medium text-center bg-gray-100 outline-none h-fit"><?=$data[1]?></textarea>
                                                <button type="submit" name="submit" class="bg-black p-1 text-white rounded h-fit">Save</button>
                                            </form>
                                        <?
                                    }
                                    if($data[0] === 'indent') {
                                        ?>
                                            <form method="POST" action="/api/index.php" class="flex gap-1 w-full">
                                                <input hidden name="newspaper_content_data_id" value="<?=$data[2]?>" />
                                                <input name="newspaper_id" hidden type="number" value="<?=$_GET['id']?>" />
                                                <textarea name="newtext" class="w-full bg-gray-100 outline-none h-[200px]"><?=$data[1]?></textarea>
                                                <button type="submit" name="submit" class="bg-black p-1 text-white rounded h-fit">Save</button>
                                            </form>
                                        <?
                                    }
                                }
                                
                            }else {
                                if($data[0] === 'title') {
                                    ?>
                                        <h2 class="text-lg font-medium text-center"><?=$data[1]?></h2>
                                    <?
                                }
                                if($data[0] === 'indent') {
                                    ?>
                                        <p><?=$data[1]?></p>
                                    <?
                                }
                            }
                        }
                    ?>
                </div>
                <?
                    if(isset($_SESSION['user_id'])) {
                        ?>
                            <form class="flex flex-col gap-2 max-w-[600px] w-full" method="post" action="/api/index.php">
                                <select class="bg-gray-100 rounded p-2 outline-none" name="newspaper_type">
                                    <option value="indent">Абзац</option>    
                                    <option value="title">Заголовок</option>
                                </select>
                                <input name="newspaper_id" hidden type="number" value="<?=$_GET['id']?>" />
                                <textarea class="bg-gray-100 rounded p-2 outline-none" name="newspaper_text" type="text" placeholder="Введите текст"></textarea>
                                <button class="bg-black text-white rounded p-2" type="submit" name="submit">Добавить текст</button>
                            </form>
                        <?
                    }
                ?>
            </div>
        </body>
        </html>

        <?
        if(isset($_GET['scroll_down'])) {
            ?>
            <script>
                window.addEventListener('load', function() {
                    // Используем requestAnimationFrame для надежного выполнения прокрутки после полной загрузки страницы
                    window.requestAnimationFrame(function() {
                        window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
                    });
                });
            </script>
            <?
        }
    }
}catch(Exception $e) {
    header('Location: /');
}

?>