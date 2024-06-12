<?php

include_once 'api/db.php';
include_once 'api/newspaper.module.php';

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
                <p>Автор: Я</p>
                <form class="flex flex-col gap-2 max-w-[600px] w-full" method="post" action="/api/index.php">
                    
                    <input name="newspaper_id" hidden type="number" value="<?=$_GET['id']?>" />
                    <textarea class="bg-gray-100 rounded p-2 outline-none" name="newspaper_text" type="text" placeholder="Введите текст"></textarea>
                    <button class="bg-black text-white rounded p-2" type="submit" name="submit">Добавить текст</button>
                </form>
                <div class="indent-6 flex flex-col gap-2">
                    <?
                        foreach(getNewspaperContentDataById($newspaper_id) as $data) {
        
                            ?>
                                <p><?=$data[0]?></p>
                            <?
                        }
                    ?>
                </div>
            </div>
        </body>
        </html>

        <?
    }
}catch(Exception $e) {
    header('Location: /');
}

?>