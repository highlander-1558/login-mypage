<?php
    session_start();

    $pdo = NULL;
    
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=lessonPHP", "root", "");
    }
    catch(Exception $e){
        die("<p>エラー</p>");
    }

    $sql = $pdo->prepare("update login_mypage set name=?, mail=?, password=?, comments=? where id = ?");
    $sql->execute([$_POST["name"], $_POST["mail"], $_POST["password"], $_POST["comments"], $_SESSION["member"]["id"]]);

    $member = $pdo->prepare("select * from login_mypage where id = ?");
    $member->execute([$_SESSION["member"]["id"]]);

    $pdo = NULL;

    foreach($member->fetch() as $key=>$val){
        $_SESSION["member"][$key] = $val;
    }

    //cookieがあった場合、更新
    if(isset($_COOKIE["mail"])){
        $period = time() + 60*60*24*7;
        setcookie("mail", $_SESSION["member"]["mail"], $period);
        setcookie("password", $_SESSION["member"]["password"], $period);        
    }

    header("Location:./mypage.php");
?>