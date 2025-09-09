<?php
$host = '127.0.0.1';
$dbUser = 'root';
$dbPwd = 'root';
$dbName = 'acmrootkl';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPwd,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>数据库连接失败：" . $e->getMessage() . "</div>");
}
?>