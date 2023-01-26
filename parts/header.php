
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP中級課題</title>

    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    
    <link rel="stylesheet" href="./stylesheet/common.css">
    <link rel="stylesheet" href="./stylesheet/register.css">
    <?php if(isset($styleFile)) : ?>
        <link rel="stylesheet" href=<?= $styleFile ?>>
    <?php endif; ?>
</head>
<body>
    <header>
        <img class="logo" src="./4eachblog_logo.jpg">

        <div class="login-toggle link-btn">
            <?php if(isset($_SESSION["member"])) : ?>
                <a href="./logout.php">ログアウト</a>
            <?php else : ?>
                <a href="./login.php">ログイン</a>
            <?php endif; ?>
        </div>
    </header>

