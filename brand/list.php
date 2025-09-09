<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>品牌管理 - 列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>品牌列表</h2>
        <div>
            <a href="../index.php" class="btn btn-outline-secondary me-2">返回首页</a>
            <a href="add.php" class="btn btn-success">新增品牌</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>品牌ID</th>
                        <th>品牌名称</th>
                        <th>品牌产地</th>
                        <th>是否启用</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../config.php';

                    $stmt = $pdo->query("SELECT * FROM brand ORDER BY brand_id DESC");
                    $brands = $stmt->fetchAll();

                    if (count($brands) === 0) {
                        echo "<tr><td colspan='6' class='text-center text-muted'>暂无品牌数据</td></tr>";
                    } else {
                        foreach ($brands as $brand) {
                            $isEnabled = $brand['is_enabled'] == 1 ?
                                "<span class='badge bg-success'>启用</span>" :
                                "<span class='badge bg-danger'>禁用</span>";

                            echo "
                            <tr>
                                <td>{$brand['brand_id']}</td>
                                <td>{$brand['brand_name']}</td>
                                <td>{$brand['origin']}</td>
                                <td>{$isEnabled}</td>
                                <td>{$brand['created_time']}</td>
                                <td>
                                    <a href='edit.php?id={$brand['brand_id']}' class='btn btn-primary btn-sm me-1'>编辑</a>
                                    <button class='btn btn-danger btn-sm' onclick='deleteBrand({$brand['brand_id']})'>删除</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 删除确认逻辑 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 删除品牌函数（带确认弹窗）
        function deleteBrand(brandId) {
            if (confirm("确定要删除该品牌吗？删除后下属手机型号也会被删除！")) {
                // 跳转到删除处理
                window.location.href = "delete.php?id=" + brandId;
            }
        }
    </script>
</body>

</html>