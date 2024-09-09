// db_connect.php
<?php
$dsn = 'mysql:host=localhost;dbname=gsacademy-ko_unit01;charset=utf8mb4'; // 新しいDB名を入力
//$dsn = 'mysql:host=localhost;dbname=gs_kadai01_db;charset=utf8mb4'; // 新しいDB名を入力
$user = 'gsacademy-ko';  // phpMyAdminで使用しているユーザー名に置き換えてください
//$user = 'root';  // phpMyAdminで使用しているユーザー名に置き換えてください
$password = 'db_connect1026';  // phpMyAdminで使用しているパスワードに置き換えてください
//$password = '';  // phpMyAdminで使用しているパスワードに置き換えてください

try {
    // PDOインスタンスを作成
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // エラーモードを例外に設定
} catch (PDOException $e) {
    echo 'DB接続エラー: ' . $e->getMessage();
    exit;
}
?>