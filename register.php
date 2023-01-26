<?php 
    session_start();
    require "./parts/header.php" 
?>

<main class="wrapper">
    <h2 class="title">会員登録</h2>

    <form action="register_confirm.php" method="post" enctype="multipart/form-data">
        <div class="input-wrapper">
            <div class="essential-mark">必須</div>
            <label>氏名</label>
            <input name="name" required>
        </div>

        <div class="input-wrapper">
            <div class="essential-mark">必須</div>
            <label>メールアドレス</label>
            <input name="mail" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required>
        </div>

        <div class="input-wrapper">
            <div class="essential-mark">必須</div>
            <label>パスワード（半角英数字6文字以上）</label>
            <input type="password" name="password" pattern="^[a-zA-z0-9]{6,}$" id="password" required>
        </div>

        <div class="input-wrapper">
            <div class="essential-mark">必須</div>
            <label>パスワード確認</label>
            <input type="password" name="password" id="confirm" oninput="ConfirmPassword(this)" required>
        </div>

        <div class="input-wrapper">
            <label>プロフィール写真</label>
            <input type="hidden" name="max_file_size" value="1000000">
            <input type="file" name="picture">
        </div>

        <div class="input-wrapper">
            <label>コメント</label>
            <textarea name="comments"></textarea>
        </div>

        <div class="btn-wrapper">
            <input type="submit" value="登録する" class="submit-btn">
        </div>
    </form>
</main>

<script>
    function ConfirmPassword(confirm){
        let input1 = password.value;
        let input2 = confirm.value;

        if(input1 != input2){
            confirm.setCustomValidity("パスワードが一致しません");
        }
        else{
            confirm.setCustomValidity("");
        }
    }
</script>

<?php require "./parts/footer.php" ?>
