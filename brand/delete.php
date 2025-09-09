<?php
require_once '../config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<div class='alert alert-danger'>参数错误！<a href='list.php'>返回列表</a></div>");
}
$brandId = (int) $_GET['id'];

try {
    $pdo->beginTransaction();

    $pdo->exec("DELETE FROM phone_model WHERE brand_id = $brandId");

    $stmt = $pdo->prepare("DELETE FROM brand WHERE brand_id = :id");
    $stmt->execute([':id' => $brandId]);

    $pdo->commit();

    echo "<div class='alert alert-success'>品牌删除成功！<a href='list.php'>返回列表</a></div>";
} catch (PDOException $e) {

    $pdo->rollBack();
    die("<div class='alert alert-danger'>删除失败：" . $e->getMessage() . "<a href='list.php'>返回列表</a></div>");
}
?>