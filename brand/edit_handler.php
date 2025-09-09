<?php
require_once '../config.php';

$brandId = (int) ($_POST['brand_id'] ?? 0);
$brandName = trim($_POST['brand_name'] ?? '');
$brandLogo = trim($_POST['brand_logo'] ?? '');
$origin = trim($_POST['origin'] ?? '');
$isEnabled = (int) ($_POST['is_enabled'] ?? 1);

if (empty($brandId) || empty($brandName) || empty($origin)) {
    die("<div class='alert alert-danger'>参数不完整！<a href='edit.php?id=$brandId'>返回重新编辑</a></div>");
}

try {
    $stmt = $pdo->prepare("
        SELECT brand_id FROM brand 
        WHERE brand_name = :name AND brand_id != :id
    ");
    $stmt->execute([':name' => $brandName, ':id' => $brandId]);
    if ($stmt->fetch()) {
        die("<div class='alert alert-warning'>该品牌名称已存在！<a href='edit.php?id=$brandId'>返回重新编辑</a></div>");
    }

    $stmt = $pdo->prepare("
        UPDATE brand 
        SET brand_name = :name, brand_logo = :logo, origin = :origin, is_enabled = :enabled, updated_time = CURRENT_TIMESTAMP
        WHERE brand_id = :id
    ");
    $stmt->execute([
        ':name' => $brandName,
        ':logo' => $brandLogo,
        ':origin' => $origin,
        ':enabled' => $isEnabled,
        ':id' => $brandId
    ]);

    echo "<div class='alert alert-success'>品牌修改成功！<a href='list.php'>返回列表</a></div>";
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>修改失败：" . $e->getMessage() . "<a href='edit.php?id=$brandId'>返回重新编辑</a></div>");
}
?>