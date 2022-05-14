<?php
$user = 'junta';
$pass = 'Fukujun0104';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
$id = (int)$_GET['id'];
try {
    $dbh = new PDO('mysql:host=localhost;dbname=bd1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql ='SELECT * FROM recipes WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $dbh = null;
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <h1>レシピの編集</h1>
</head>
<body>
    <br>
    <form method="post" action="update.php?id=
    <?= htmlspecialchars($result['id'], ENT_QUOTES) ?>">
    <div class="stop">
    料理名:</div>
    <input type="text" name="recipe_name" value="<?php echo htmlspecialchars($result['recipe_name'], ENT_QUOTES); ?>"><br>
    <div class="nav">
    カテゴリ:</div>
    <select class="form-select" name="category">
        <option hidden>選択してください</option>
        <option value="1" <?php if ($result['category'] == 1) echo 'selected' ?>>和食</option>
        <option value="2" <?php if ($result['category'] == 2) echo 'selected' ?>>中華</option>
        <option value="3" <?php if ($result['category'] == 3) echo 'selected' ?>>洋食</option>
    </select>
    <div class="start">
    難易度:</div>
    <input type="radio" name="difficulty" value="1" <?php if ($result['difficulty'] == 1) echo 'checked' ?>>簡単
    <input type="radio" name="difficulty" value="2" <?php if ($result['difficulty'] == 2) echo 'checked' ?>>普通
    <input type="radio" name="difficulty" value="3" <?php if ($result['difficulty'] == 3) echo 'checked' ?>>難しい
    <br>
    <div class="poket">
    予算:</div>
    <input type="number" name="budget" value="<?= htmlspecialchars($result['budget'], ENT_QUOTES) ?>">円
    <br>
    <div class="monster">
    作り方:</div>
    <textarea class="form-control" name="howto" cols="40" rows="4" maxlength="320"><?= htmlspecialchars($result['howto'], ENT_QUOTES) ?></textarea>
    <br>
    <input type="submit" class="btn-primary" value="送信">
    </form>
<style>
    .form-control{
        font-size: 17px;
             font-family: "MS明朝";
    }
    body{
             padding: 20px;
             text-align:left;
             background-image:radial-gradient(rgba(255, 255, 255,0.3),rgba(255,255,255,1)) ,url(https://cdn.pixabay.com/photo/2016/12/26/17/28/spaghetti-1932466_1280.jpg);  
             background-color:rgba(255,255,255,0.8);
             background-blend-mode:lighten;
             max-width: 600px;
             
         }
         h1{
            padding: 10px 10px 10px 10px;
            margin: 0 auto;
            border-radius: 5px;
            width: 1400px;
            opacity: 0.9;
            text-align: left;
            font-family: "MS明朝";
            font-weight: 800;
            background:rgba(255,255,224,0.5);
         }
         .text{
             margin-top: 20px;
         }
         .form-select{
             font-size: 15px;
             font-family: "MS明朝";
         }
         .nav{
             font-size: 20px;
             font-family: "MS明朝";
             margin-top: 5px;
         }
         .stop{
            font-size: 20px;
             font-family: "MS明朝";
         }
         .start{
             margin-top: 5px;
            font-size: 20px;
             font-family: "MS明朝";
         }
         .form-check{
            font-size: 15px;
             font-family: "MS明朝";
         }
         .poket{
            margin-top: 5px;
            font-size: 17px;
             font-family: "MS明朝";
         }
         .monster{
            margin-top: 5px;
            font-size: 17px;
             font-family: "MS明朝";
         }
</style>
</body>
 </html>
