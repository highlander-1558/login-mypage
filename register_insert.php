<?php
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=lessonPHP", "root", "");
        $sql = $pdo->prepare("insert into login_mypage values(null, ?, ?, ?, ?, ?)");
        $sql->execute([$_POST["name"], $_POST["mail"], $_POST["password"], $_POST["picture"], $_POST["comments"]]);

        //プロフィール画像の名前を重複しないようにリネーム
        $sql = $pdo->prepare("select id from login_mypage where mail=? && password=?");
        $sql->execute([$_POST["mail"], $_POST["password"]]);
        $sql = $sql->fetch();

        $id = $sql["id"];

        $old_path = "./profile_images/" . $_POST["picture"];
        $new_path = "./profile_images/" . "id" . $id . "_" . $_POST["picture"];
        rename($old_path, $new_path);
        $sql = $pdo->prepare("update login_mypage set picture = ? where id = ?");
        $sql->execute([$new_path, $id]);

        $pdo = NULL;

        header("Location:./after_register.php");
    }
    catch(Exception $e){
        echo "<p>データの挿入に失敗しました。</p>";
    }
?>