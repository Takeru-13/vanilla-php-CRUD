<?php include 'header-include.php'; ?>

<!-- ==== 1. PHP基礎練習ゾーン ==== -->
<?php
$num = 10;
$str = "hello";
$flag = true;
$arr = [1, 2, 3];
$person = ["name" => "Taro", "age" => 20];

echo "$num <br>$str <br>$flag <br>$arr[1]<br>";

if($num > 5){
  echo "5より大きい<br>";
} else {
  echo "5より小さい<br>";
}

for ($i = 0; $i <= 10; $i++) {
  echo "for: $i<br>";
}

function greet($name) {
  return "Hello," . $name . "！";
}
echo greet("takeru") . "<br>";

echo "helloは" . strlen("Hello") . "文字です<br>";
echo "strtoupperを使うと" . strtoupper("hello") . "こうなります<br>";

echo count($arr) . "<br>";
echo $arr[2] . "<br>";

foreach($person as $key => $value) {
  echo $key . ": $value<br>";
}

// 名前送信フォーム＆挨拶
if(!empty($_POST['yourname'])){
  echo "こんにちは、" . htmlspecialchars($_POST['yourname']) . "さん!<br>";
}
?>

<form method="post">
  名前:<input type="text" name="yourname">
  <input type="submit" value="送信">
</form>

<hr>

<!-- ==== 2. 商品追加・一覧ゾーン ==== -->
<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud_db;charset=utf8', 'root', '');

// 商品追加フォームの処理
if (!empty($_POST['name']) && preg_match('/^[0-9]+$/', $_POST['price'])) {
  $sql = $pdo->prepare('INSERT INTO product (name, price) VALUES (?, ?)');
  $sql->execute([htmlspecialchars($_POST['name']), $_POST['price']]);
}

// 商品一覧
$result = $pdo->query('SELECT * FROM product');
?>

<h2>商品追加フォーム</h2>
<form method="post">
  商品名: <input type="text" name="name">
  価格: <input type="text" name="price">
  <input type="submit" value="追加">
</form>

<h2>商品一覧</h2>
<?php foreach($result as $row): ?>
  <?= htmlspecialchars($row['name']) ?> - <?=$row['price']?>円<br>
<?php endforeach; ?>
