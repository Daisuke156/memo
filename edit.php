
<?php

  $dsn = "mysql:dbname=php_tools;host=localhost;charset=utf8mb4";
  $username = "root";
  $password = "";
  $options = [];
  $pdo = new PDO($dsn, $username, $password, $options);

  $id = $_POST["id"];
  $title = $_POST["title"];
  $contents = $_POST["contents"];

?>

<html>
  <head>
    <title>memo</title>
  </header>
  <body>
    <h1>編集</h1>
    <form action="memo.php" method="post"> 
      <input type="hidden" name="id" value="<?php echo $id?>"></input>
      <h2>Title</h2>
      <input type="text" name="title" size="20" value="<?php echo $title ?>"></input><br>
      <h2>Contents</h2>
      <textarea name="contents" style="width:300px; height:100px;"><?php echo $contents ?></textarea><br>
      <input type="submit" name="update" value="更新"></input>
    </form>
  </body>
</html>