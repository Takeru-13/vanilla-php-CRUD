<?php
$pdo = new PDO('mysql:host=localhost;dbname=crud_db;charset=utf8', 'root', '');

if (!empty($_POST['name']) && preg_match('/^[0-9]+$/', $_POST['price'])) {
  $sql = $pdo->prepare('INSERT INTO product (name, price) VALUES (?, ?)');
  $sql->execute([htmlspecialchars($_POST['name']), $_POST['price']]);
}

$products = $pdo->query('SELECT * FROM product')->fetchAll();
?>

<h2>商品追加</h2>
<form method="post">
  商品名: <input type="text" name="name">
  価格  : <input type="text" name="price">
  <input type="submit" value="商品追加">
</form>

<h2>商品一覧</h2>
<table border="1">
  <tr>
    <th>ID</th>
    <th>商品名</th>
    <th>価格</th>
    <th>操作</th>
  </tr>
  <?php foreach ($products as $p): ?>
  <tr>
      <td><?= $p['id'] ?></td>
      <td><?= htmlspecialchars($p['name']) ?></td>
      <td><?= $p['price'] ?>円</td>
      <td>
        <a href="edit.php?id=<?= $p['id'] ?>">編集</a>
        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('削除しますか？')">削除</a>
      </td>
  </tr>
  <?php endforeach; ?>
</table>
