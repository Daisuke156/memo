<?php 
  $dsn = "mysql:dbname=php_tools;host=localhost;charset=utf8mb4";
  $username = "root";
  $password = "";
  $options = [];
  $pdo = new PDO($dsn, $username, $password, $options);
//  追加ボタンが押された時の処理
  if(null !== @$_POST["create"]) {
    if(@$_POST["title"] != "" OR @$_POST["contents"] != ""){
      date_default_timezone_set('Asia/Tokyo');
      $created_at = date("Y-m-d H:i:s");
      $stmt = $pdo->prepare("INSERT INTO memo(title,contents,created_at) VALUE (:title,:contents,:created_at)");
      $stmt->bindvalue(":title", @$_POST["title"]);
      $stmt->bindvalue(":contents", @$_POST["contents"]);
      $stmt->bindvalue(":created_at", $created_at);
      $stmt->execute();
    }
  }
//　変更ボタンが押された時の処理
  if (null !== @$_POST["update"]){
    $stmt = $pdo->prepare("UPDATE memo SET title=:title, contents=:contents WHERE ID=:id");
    $stmt->bindvalue(":title", @$_POST["title"]);
    $stmt->bindvalue(":contents", @$_POST["contents"]);
    $stmt->bindvalue(":id", @$_POST["id"]);
    $stmt->execute();
  }
//　削除ボタンが押された時の処理
  if (null !== @$_POST["delete"]){
    $stmt = $pdo->prepare("DELETE FROM memo WHERE ID=:id");
    $stmt->bindvalue(":id", @$_POST["id"]);
    $stmt->execute();
  }
?>

<html>
  <head>
    <title>memo</title>
  </header>
  <body>
    <a href="create.php">新規作成</a>
    <h1>メモ一覧</h1>
    <?php 
      //テーブルからデータを取得
      $stmt = $pdo->query("SELECT * FROM memo ORDER BY id DESC");
      foreach ($stmt as $row):
    ?>
    <form action="edit.php" method="post">
      <input type="hidden" name="id" value="<?php echo $row[0]?>"></input>
      <p>time:<?php echo $row[3]?></p>
      <h2>Title</h2>
      <input type="hidden" name="title" size="20" value="<?php echo $row[1]?>"></input><br>
      <p><?php echo $row[1] ?></p>
      <h2>Contents</h2>
      <input type="hidden" name="contents" style="width:300px; height:100px;" value="<?php echo $row[2]?>"></input>
      <p><?php echo $row[2] ?></p>
      <input type="submit" name="update" value="変更">
    </form>
    <form action="memo.php" method="post">
      <input type="hidden" name="id" value="<?php echo $row[0]?>"></input>
      <input type="submit" name="delete" value="削除">
      <div>-------------------------------------------------------------------------------</div>
    </form>
    <?php endforeach; ?>
  </body>
</html>