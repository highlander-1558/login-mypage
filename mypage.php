<?php
    $styleFile = "./stylesheet/mypage.css";
    session_start();
?>

<?php
    //ログイン画面から異動してきたとき
    if(!empty($_POST)){
        $pdo = NULL;
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=lessonPHP", "root", "");
        }catch(PDOException $e){
            die("<p>サーバーエラー</p><br>
                 <a href='./login.php'>ログイン画面へ</a>");
        }
        
        $member = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

        $member->execute([$_POST["mail"], $_POST["password"]]);
        $member = $member->fetch();

        if(empty($member)){//ログイン失敗
            $_SESSION["error"] = "メールアドレスまたはパスワードが間違っています。";
            header("Location:./login.php");
        }
        else{//ログイン成功
            foreach($member as $key => $val){
                $_SESSION["member"][$key] = $val;
            }

            //cookie
            if(!empty($_POST["keepLogin"])){
                $period = time() + 60*60*24*7;
                setcookie("mail", $_SESSION["member"]["mail"], $period);
                setcookie("password", $_SESSION["member"]["password"], $period);
            }
        }
        $pdo = NULL;
    }
    //ログインしていない場合
    else if(!isset($_SESSION["member"])){
        header("Location:./login.php");
    }
    
    //デフォルト画像
    $profile_img = "./profile_pic.jpg";
    if(!empty($_SESSION["member"]["picture"])){
        $profile_img = $_SESSION["member"]["picture"];
    }

    //ログインの判定のため、ここでヘッダーを要求
    require "./parts/header.php"; 
?>

<main class="wrapper">
    <h2 class="title">会員情報</h2>

    <p class="welcome-text">こんにちは！ <?= $_SESSION["member"]["name"] ?>さん</p>

    <div class="member-wrapper">
        <img class="profile-img" src=<?= $profile_img ?>>
        <table class="member-right-contents">
            <tr>
                <th>氏名</th>
                <td><?= $_SESSION["member"]["name"] ?></td>
            </tr>
            <tr>
                <th>メール</th>
                <td><?= $_SESSION["member"]["mail"] ?></td>
            </tr>
            <tr>
                <th>パスワード</th>
                <td><?= $_SESSION["member"]["password"] ?></td>
            </tr>
        </table>
    </div>

    <p class="comments">
        <?= $_SESSION["member"]["comments"] ?>
    </p>

    <div class="btn-wrapper">
        <form action="./edit_mypage.php" method="post">
            <button class="submit-btn" type="submit" value=<?= rand(1,10) ?> name="fromMypage">編集する</button>
        </form>
        
    </div>
</main>

<?php require "./parts/footer.php"; ?>