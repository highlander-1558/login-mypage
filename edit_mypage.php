<?php
    $styleFile = "./stylesheet/mypage.css";
    session_start();
    require "./parts/header.php"; 
?>

<?php
    //ログインしていない場合
    if(!isset($_SESSION["member"])){
        header("Location:./login.php");
    }
    //URLで直接来た場合
    if(empty($_POST["fromMypage"])){
        $_SESSION["error"] = "登録情報の変更にはログインが必要です。";
        header("Location:./login.php");
    }
    
    //デフォルト画像
    $profile_img = "./profile_pic.jpg";
    if(!empty($_SESSION["member"]["picture"])){
        $profile_img = $_SESSION["member"]["picture"];
    }
?>

<main class="wrapper">
    <h2 class="title">会員情報</h2>

    <p class="welcome-text">こんにちは！ <?= $_SESSION["member"]["name"] ?>さん</p>

    <form action="./update_mypage.php" method="post">
        <div class="member-wrapper">
            <img class="profile-img" src=<?= $profile_img ?>>
            <table class="member-right-contents">
                <tr>
                    <th>氏名</th> 
                    <td><input name="name" value=<?= $_SESSION["member"]["name"] ?>></td>
                </tr>
                <tr>
                    <th>メール</th>
                    <td><input name="mail" value=<?= $_SESSION["member"]["mail"] ?> pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}"></td>
                </tr>
                <tr>
                    <th>パスワード</th> 
                    <td><input name="password" value=<?= $_SESSION["member"]["password"] ?> pattern="^[a-zA-z0-9]{6,}$"></td>
                </tr>
            </table>
        </div>

        <p class="comments">
            <textarea name="comments"><?= $_SESSION["member"]["comments"] ?></textarea>
        </p>

        <div class="btn-wrapper">
            <input type="submit" value="この内容に変更する" class="submit-btn">
        </div>
    </form>
</main>

<?php require "./parts/footer.php"; ?>