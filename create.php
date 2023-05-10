<?php

// dbconnect.phpを読み込む→DBに接続
include_once('./dbconnect.php');

// 新しいレコードを追加する処理
// 処理の流れ
// ゴール：新しい家計簿が追加されて、TOPに戻る
 // 1.画面で入力された値の取得
 // 2.PHPからMysqlへ接続→dbconnect.phpを読み込む
 // 3.SQL文を作成して、画面で入力された値をrecordsテーブルに追加
 // 4.index.phpに画面遷移する

// 送られてきた内容を確認するために実行、デバック、スーパーグローバル変数をPHPドキュメントで確認
// var_dump($_POST);
// $_POSTの値は必ずname属性の値を取得できる
$date = $_POST['date'];
$title = $_POST['title'];
$amount = $_POST['amount'];
$type = $_POST['type'];

/* 値が取得できているか確認
echo $date;
echo '<br>';
echo $title;
echo '<br>';
echo $amount;
echo '<br>';
echo $type;
echo '<br>';
*/

// INSERT文の作成、recordsテーブルの中のカラムを設定していく
$sql = "INSERT INTO records(title, type, amount, date, created_at, updated_at) VALUES(:title, :type, :amount, :date, now(), now())";

// 作成したSQLを実行できるよう準備
$stmt = $pdo->prepare($sql);

// 値の設定、何を保存するのかを設定、bind=結びつける、パラメーター=外部から投入されたデータのことをいう
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':type', $type, PDO::PARAM_INT);
$stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);

// SQLを実行
$stmt->execute();

// index.phpに遷移
header('Location: ./index.php');

?>