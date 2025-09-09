<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手机SKU管理 - 列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>手机SKU列表</h2>
        <div>
            <a href="../index.php" class="btn btn-outline-secondary me-2">返回首页</a>
            <a href="add_sku.php" class="btn btn-success">新增SKU</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>SKU ID</th>
                        <th>关联型号ID</th>
                        <th>SKU编码</th>
                        <th>颜色</th>
                        <th>存储组合</th>
                        <th>销售价(元)</th>
                        <th>成本价(元)</th>
                        <th>库存数量</th>
                        <th>库存预警值</th>
                        <th>颜色图片</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../config.php';

                    $stmt = $pdo->query("SELECT * FROM phone_sku ORDER BY sku_id DESC");
                    $skus = $stmt->fetchAll();

                    if (count($skus) === 0) {
                        echo "<tr><td colspan='13' class='text-center text-muted'>暂无SKU数据</td></tr>";
                    } else {
                        foreach ($skus as $sku) {

                            $displayValues = [];
                            foreach ($sku as $key => $value) {
                                $displayValues[$key] = $value ?? '-';
                            }

                            $stockClass = $sku['stock_quantity'] <= $sku['stock_warning'] ? 'text-danger fw-bold' : '';

                            $colorImage = $displayValues['color_image'] !== '-' ?
                                "<a href='{$displayValues['color_image']}' target='_blank'>查看</a>" :
                                '-';

                            echo "
                            <tr>
                                <td>{$displayValues['sku_id']}</td>
                                <td>{$displayValues['model_id']}</td>
                                <td>{$displayValues['sku_code']}</td>
                                <td>{$displayValues['color']}</td>
                                <td>{$displayValues['storage_combo']}</td>
                                <td>{$displayValues['selling_price']}</td>
                                <td>{$displayValues['cost_price']}</td>
                                <td class='{$stockClass}'>{$displayValues['stock_quantity']}</td>
                                <td>{$displayValues['stock_warning']}</td>
                                <td>{$colorImage}</td>
                                <td>{$displayValues['created_time']}</td>
                                <td>{$displayValues['updated_time']}</td>
                                <td>
                                    <a href='edit_sku.php?id={$sku['sku_id']}' class='btn btn-primary btn-sm me-1'>编辑</a>
                                    <button class='btn btn-danger btn-sm' onclick='deleteSku({$sku['sku_id']})'>删除</button>
                                </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteSku(skuId) {
            if (confirm("确定要删除该SKU吗？删除后将无法恢复！")) {
                window.location.href = "delete_sku.php?id=" + skuId;
            }
        }
    </script>
</body>

</html>