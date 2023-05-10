<?php

include_once('./dbconnect.php');

//1. 画面で入力された値の取得
// editFormのformタグの下に隠してIDを渡してあげるようにする
//2. PHPからMySQLへ接続
//3. SQL分を作成して、画面で入力された値でrecordsテーブルを更新
// editFormにvalue="0"と"1"を追加する
//4. index.phpに画面遷移する

$date = $_POST['date'];
$title = $_POST['title'];
$amount = $_POST['amount'];
$type = $_POST['type'];
$id = $_POST['id'];

// var_dump($_POST);

$sql = "UPDATE records SET title = :title, type = :type, amount = :amount, date = :date, updated_at = now() WHERE id = :id";
// var_dump($sql);
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':type', $type, PDO::PARAM_INT);
$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

$stmt->execute();

// var_dump($stmt);

// index.phpに遷移
header('Location: ./index.php');
exit;

?>