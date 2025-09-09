<?php
require_once '../config.php';

$brandName = trim($_POST['brand_name'] ?? '');
$brandLogo = trim($_POST['brand_logo'] ?? '');
$origin = trim($_POST['origin'] ?? '');
$isEnabled = (int) ($_POST['is_enabled'] ?? 1);

if (empty($brandName) || empty($origin)) {
    die("<div class='alert alert-danger'>品牌名称和产地为必填项！<a href='add.php'>返回重新填写</a></div>");
}

try {
    $stmt = $pdo->prepare("SELECT brand_id FROM brand WHERE brand_name = :name");
    $stmt->execute([':name' => $brandName]);
    if ($stmt->fetch()) {
        die("<div class='alert alert-warning'>该品牌名称已存在！<a href='add.php'>返回重新填写</a></div>");
    }

    $stmt = $pdo->prepare("
        INSERT INTO brand (brand_name, brand_logo, origin, is_enabled)
        VALUES (:name, :logo, :origin, :enabled)
    ");
    $stmt->execute([
        ':name' => $brandName,
        ':logo' => $brandLogo,
        ':origin' => $origin,
        ':enabled' => $isEnabled
    ]);

    echo "<div class='alert alert-success'>品牌新增成功！<a href='list.php'>返回列表</a></div>";
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>新增失败：" . $e->getMessage() . "<a href='add.php'>返回重新填写</a></div>");
}
?>