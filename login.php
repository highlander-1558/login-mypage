<?php 
    session_start();
    if(isset($_SESSION["member"])){
        header("Location:./mypage.php");
    }


    $styleFile = "./stylesheet/login.css";
    require "./parts/header.php";

    $keepLogin="";
    $mail="";
    $password="";
    if(isset($_COOKIE["mail"])){
        $keepLogin = "checked";
        $mail = $_COOKIE["mail"];
        $password = $_COOKIE["password"];
    }
?>

<main class="wrapper">

    <?php 
        if(isset($_SESSION["error"])) :       
    ?>
        <div class="error-message">
            <?= $_SESSION["error"] ?>
        </div>
    <?php 
            unset($_SESSION["error"]);
        endif; 
    ?>

    <form action="./mypage.php" method="post" class="login-form">
        <div class="input-wrapper">
            <label>メールアドレス</label>
            <input name="mail" required value=<?= $mail ?>>
        </div>

        <div class="input-wrapper">
            <label>パスワード</label>
            <input type="password" name="password" required value=<?= $password ?>>
        </div>

        <div class="input-wrapper input-wrapper--checkbox">
            <label>
                <input type="checkbox" name="keepLogin" <?= $keepLogin ?> value="1">
                ログイン状態を維持する
            </label>
        </div>

        <div class="btn-wrapper">
            <input type="submit" value="ログイン" class="submit-btn">
        </div>
    </form>

    <div class="to-register link-btn">
            <a href="./register.php">新規登録へ</a>
    </div>
</main>

<?php require "./parts/footer.php"; ?>
