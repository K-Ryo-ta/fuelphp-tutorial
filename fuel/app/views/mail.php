<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>メール送信テスト</title>
</head>

<body>

  <form action="./form.php" method="post">
    <label for="email">宛先メールアドレス</label>
    <input type="text" id="email" name="email">
    <label for="subject">件名</label>
    <input type="text" id="subject" name="subject">
    <label for="body">本文</label>
    <textarea id="body" name="body"></textarea>
    <input type="submit" value="送信">
  </form>

  <style>
    label,
    input,
    textarea {
      display: block;
    }

    input,
    textarea {
      width: 500px;
      margin-bottom: 20px;
    }

    textarea {
      height: 100px;
    }
  </style>

  <?php
  if (isset($_POST['email'])) {
    mb_send_mail($_POST['email'], $_POST['subject'], $_POST['body'], array('From' => 'webmaster@example.com'));
  }
  ?>

</body>

</html>
