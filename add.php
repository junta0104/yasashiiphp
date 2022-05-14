<?php
$user = 'junta';
$pass = 'Fukujun0104';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int)$_POST['category'];
$difficulty = (int)$_POST['difficulty'];
$budget = (int)$_POST['budget'];
try{
    $dbh = new PDO('mysql:host=localhost;dbname=bd1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(1, $recipe_name, PDO::PARAM_STR);
    $stmt->bindvalue(2, $category, PDO::PARAM_INT);
    $stmt->bindvalue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindvalue(4, $budget, PDO::PARAM_INT);
    $stmt->bindvalue(5, $howto, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo 'レシピの登録が完了しました。<br>';
    echo '<a href="index.php">トップページへ戻る</a>';
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES ). '<br>';
    exit;
}
