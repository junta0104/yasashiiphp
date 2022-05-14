<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <h1>料理レシピ</h1>
</head>
<body>
    <style>
        body{
            text-align:left;
            padding:10px;
            background-image: radial-gradient(rgba(255, 255, 255,0.3),rgba(255,255,255,1)) ,url(https://cdn.pixabay.com/photo/2016/12/26/17/28/spaghetti-1932466_1280.jpg);
            background-size:  cover;   
            background-color:rgba(255,255,255,0.8);
            background-blend-mode:lighten;
            font-size: 25px;
            font-family: "MS明朝";
            font-weight:700;
        }
        h1{
            padding: 10px 10px 10px 10px;
            margin: 0 auto;
            border-radius: 5px;
            width: 1400px;
            background-color: #ffffe0;
            font-family: "MS明朝";
            opacity: 0.9;
            background-color: transparent;
            background:rgba(255,255,224,0.5);
            margin-bottom: 30px;
        }
    </style>
<?php
$user ='junta';
$pass ='Fukujun0104';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください';
    exit;
}
try {
    $id = (int)$_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=bd1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM recipes WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
     echo  '料理名:' . htmlspecialchars($result['recipe_name'], ENT_QUOTES) . '<br>' . PHP_EOL;
    echo 'カテゴリ:' .
    match ($result['category']) {
        '1' => '和食',
        '2' => '中華',
        '3' => '洋食',
    } . '<br>' . PHP_EOL;
    echo '予算:' . htmlspecialchars($result['budget'], ENT_QUOTES) . '<br>' . PHP_EOL;
    echo '難易度:' .
    match ($result['difficulty']) {
        '1' => '簡単',
        '2' => '普通',
        '3' => '難しい',
    } . '<br>' . PHP_EOL;
    echo '作り方:<br>' . nl2br(htmlspecialchars($result['howto'], ENT_QUOTES)) . '<br>' . PHP_EOL;
    
    $dbh = null;
    echo '<a href="index.php">トップページへ戻る</a>';

} 
catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
</body>
</html>
