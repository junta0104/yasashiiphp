<!DOCTYPE html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レシピの削除</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <style>
        body{
            text-align:lert;
            padding:10px;
            background-image: radial-gradient(rgba(255, 255, 255,0.3),rgba(255,255,255,1)) ,url(https://cdn.pixabay.com/photo/2016/12/26/17/28/spaghetti-1932466_1280.jpg); 
            background-color:rgba(255,255,255,0.8);
            background-blend-mode:lighten;
            margin-top: 10px;
            font-family: "MS明朝";
            font-size: 30px
        }
        title{
            padding: 10px 10px 10px 10px;
            margin: 0 auto;
            border-radius: 5px;
            width: 1400px;
            font-family: "MS明朝";
            opacity: 0.9;
            background-color: transparent;
            background:rgba(255,255,224,0.5);
            margin-bottom: 30px;
        }
    </style>
<?php
$user = 'junta';
$pass = 'Fukujun0104';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
try {
    $id = (int)$_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=bd1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM recipes WHERE id =?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
    echo 'ID: ' . htmlspecialchars($id, ENT_QUOTES) . 'の削除が完了しました。<br>';
    echo '<a href="index.php">トップページへ戻る</a>';
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
</body>
</html>
