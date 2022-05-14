<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    
    <title>レシピの一覧</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f1995e7595.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center  text-dark  ">レシピの一覧 </h1>
    <br>
    <p style="text-align: right">現在時刻：<span id="text"></span></p>

  <script type="text/javascript">
  document.getElementById("text").innerHTML = showTime();
  
  function showTime() {
    var now = new Date();
    var nowhour = now.getHours();
    var nowminutes = now.getMinutes();
    var nowseconds = now.getSeconds();
  
    var text = nowhour + "時" + nowminutes + "分" ; 
    
    return text;
  }
  </script>
    
    <a href="form.html"><i class="fa-regular fa-pen-to-square"></i>レシピの新規登録</a>
    <a href="study,html"><i class="fa-solid fa-blog"></i>お問い合わせ</a>
    

    <style>
        
        body{
            padding:10px;
            background-image: radial-gradient(rgba(255, 255, 255,0.3),rgba(255,255,255,1)) ,url(https://cdn.pixabay.com/photo/2016/12/26/17/28/spaghetti-1932466_1280.jpg);
            background-size:  cover;   
            background-color:rgba(255,255,255,0.8);
            background-blend-mode:lighten;
        }
        h1{
            position: relative;
            padding: 1rem 2rem calc(1rem + 10px);
            background-color: rgba(255,255,0,0.3);
            opacity: 0.9;
        }
        h1:before {
        position: absolute;
        top: -7px;
        left: -7px;
        width: 100%;
        height: 100%;
        content: '';
        border: 4px solid #000;
        }

        
        p{
            font-weight: 700;
            font-size: 20px;
            font-family: "MS明朝";
            padding: 10px;
        }
        a{
            font-size:  20px;  
            margin: 400px 5px 5px 5px;
            letter-spacing: 0.12em;
            font-weight:800;
            width: 1700px;
            font-family: "MS明朝";
            

        }
        table{
            
            
            width: 1200px;
            min-height:100vh;
             text-align:center;
             font-size: 30px;
             letter-spacing: 0.1em;
             font-family: "MS明朝";
             font-weight:40;
             border: 1px solid #333;
             border-width: 2px;
             
             border-radius: 50px;
             
             padding: 5px;
             margin: 0 auto;
             margin-top: 50px;
             opacity: 0.9;    
             background:rgba(238,220,179,1);
        }
        th{
            font-size: 25px;
            font-weight:800;
             letter-spacing: 0.1em;
             font-family: "MS明朝";
             font-weight:lighter;
             background-color: transparent;
             background:rgba(217,227,103,0.9);
             margin: 10px 10px 10px 10px ;
             border: 1px solid #333;
             border-width: 1px;
             background:rgba(196,154,106,0.7); 
             
        }
        td{
            font-size: 20px;
            letter-spacing: 0.1em;
             font-family: "MS明朝";
             font-weight:400;
             border: 1px solid #333;
             border-width: 1px;
             border-radius: 50px;
             border-spacing: 0;
        }
     </style>   

<?php
$user ='junta';
$pass ='Fukujun0104';
try {
$dbh = new PDO('mysql:host=localhost;dbname=bd1;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT * FROM recipes';
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table>' . PHP_EOL;
echo '<tr>' . PHP_EOL;
echo '<th><font color="black">料理名</font></th>
      <th><font color="black">予算</font></th>
      <th><font color="black">難易度</th></font>
      <th><font color="black">編集</th></font>' . PHP_EOL;
echo '</tr>' . PHP_EOL;
foreach ($result as $row) {
    echo '<tr>' . PHP_EOL;
    echo '<td style="color:black">' . htmlspecialchars($row['recipe_name'], ENT_QUOTES) . '</td>' . PHP_EOL;
    echo '<td style="color:black">' . htmlspecialchars($row['budget'], ENT_QUOTES) . '</td>' . PHP_EOL;
    echo '<td style="color:black">' . 
    match ($row['difficulty']) {
        '1' => '簡単',
        '2' => '普通',
        '3' => '難しい',
    } . '</td>' . PHP_EOL;
    echo '<td>' . PHP_EOL;

    echo '<a href="detail.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '"><i class="fa-solid fa-bars"></i>詳細</a>' . PHP_EOL;
    echo '|<a href="edit.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '"><i class="fa-solid fa-arrows-rotate"></i>変更</a>' . PHP_EOL;
    echo '|<a href="delete.php?id=' . htmlspecialchars($row['id'], ENT_QUOTES) . '"><i class="fa-regular fa-trash-can"></i>削除</a>' . PHP_EOL;
    echo '</td>' . PHP_EOL; 
    echo '</tr>' . PHP_EOL;
}
echo '</table>' . PHP_EOL;



$dbh = null;
} catch (PDOException $e) {
    echo 'エラー発生: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}

?>
</body>
</html>