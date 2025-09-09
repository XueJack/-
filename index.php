<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手机数据管理系统 - 首页</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1 class="text-center text-primary mb-5">手机数据管理系统</h1>

    <div class="row g-4 mb-6">
        <?php
        require_once 'config.php';
        $modules = [
            ['name' => '品牌', 'table' => 'brand', 'url' => 'brand/list.php'],
            ['name' => '手机型号', 'table' => 'phone_model', 'url' => 'brand/phone_model.php'],
            ['name' => '配置参数', 'table' => 'phone_spec', 'url' => 'brand/phone_spec.php'],
            ['name' => 'SKU', 'table' => 'phone_sku', 'url' => 'brand/phone_sku.php'],
            ['name' => '合规信息', 'table' => 'compliance_info', 'url' => 'brand/compliance_info.php']
        ];

        foreach ($modules as $mod) {
            $count = $pdo->query("SELECT COUNT(*) AS num FROM {$mod['table']}")->fetch()['num'];
            echo "
            <div class='col-md-4 col-sm-6'>
                <div class='card bg-light h-100'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>{$mod['name']}总数</h5>
                        <p class='card-text display-4 text-success'>{$count}</p>
                        <a href='{$mod['url']}' class='btn btn-primary btn-sm'>进入管理</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">选择模块进行操作</p>
        <a href="brand/list.php" class="btn btn-outline-primary me-2">品牌管理</a>
        <a href="brand/phone_model.php" class="btn btn-outline-primary me-2">型号管理</a>
        <a href="brand/phone_spec.php" class="btn btn-outline-primary me-2">配置管理</a>
        <a href="brand/phone_sku.php" class="btn btn-outline-primary me-2">SKU管理</a>
        <a href="brand/compliance_info.php" class="btn btn-outline-primary">合规管理</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>