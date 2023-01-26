<?php 
    session_start();
    require "./parts/header.php"; 
?>

<?php
    //確認前に画像を保存してしまっている　また同名の場合は？
    $fromPath = $_FILES["picture"]["tmp_name"];
    $picName = $_FILES["picture"]["name"];
    $destPath = "./profile_images/" . $picName;

    move_uploaded_file($fromPath, $destPath);

?>

<main class="wrapper">
    <h2 class="title">会員登録　確認</h2>
    <p class="text">こちらの内容でよろしいでしょうか？</p>

    <table class="confirm-table">
        <tr>
            <th>氏名</th>
            <td><?= $_POST["name"] ?></td>
        </tr>

        <tr>
            <th>メール</th>
            <td><?= $_POST["mail"] ?></td>
        </tr>

        <tr>
            <th>パスワード</th>
            <td><?= $_POST["password"] ?></td>
        </tr>

        <tr>
            <th>プロフィール画像</th>
            <td><?= $picName ?></td>
        </tr>

        <tr>
            <th>コメント</th>
            <td><?= $_POST["comments"] ?></td>
        </tr>
    </table>

    <div class="btn-wrapper">
        <form action="register.php" method="post">
            <!-- 本来はないもの -->
            <input type="hidden" name="cancel">
            <input type="submit" value="戻って修正する" class="submit-btn submit-btn--cancel">
        </form>

        <form action="register_insert.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="name" value=<?= $_POST["name"] ?>>
            <input type="hidden" name="mail" value=<?= $_POST["mail"] ?>>
            <input type="hidden" name="password" value=<?= $_POST["password"] ?>>
            <!-- input type="hidden" name="picture" value=<?= $destPath ?> -->
            <input type="hidden" name="picture" value=<?= $picName ?>>
            <input type="hidden" name="comments" value=<?= $_POST["comments"] ?>>

            <input type="submit" value="登録する" class="submit-btn">
        </form>
    </div>
</main>

<?php require "./parts/footer.php"; ?>