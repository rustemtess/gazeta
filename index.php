<?

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
            <a class="bg-black rounded p-2 text-white" href="/admin.php">Админ панель</a>
            <form method="POST" class="flex items-center gap-2">
                <input class="bg-gray-100 rounded p-2 outline-none" name="search_text" type="text" placeholder="Поиск" />
                <button class="bg-black rounded p-2 text-white" name="search">Поиск</button>
            </form>
        </header>
        <main>
            <nav class="flex flex-col gap-4 p-4">
                <?
                if(count($arr) === 0) {
                    ?>
                        <h3>Ничего нет</h3>
                    <?
                } else {
                    foreach($arr as $newspaper) {
                        ?>
                        <div class="flex gap-4 justify-start">
                            <img class="rounded-lg" src="/api/uploads/<?=$newspaper['newspaper_content_img']?>" width="220" />
                            
                            <div class="flex flex-col gap-2">
                                <p class="text-xl"><?=$newspaper['newspaper_title']?></p>
                                <p class="text-lg"><?=explode("-", $newspaper['newspaper_date'])[0]?> год</p>
                                <a class="text-center bg-black rounded p-2 text-white" href="/gazeta.php?id=<?=$newspaper['newspaper_id']?>">Открыть газету</a>
                            </div>
                        </div>
                        <?
                    }
                }
                
                ?>
            </nav>
        </main>
    </div>
</body>
</html>