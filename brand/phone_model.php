<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手机型号管理 - 列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>手机型号列表</h2>
        <div>
            <a href="../index.php" class="btn btn-outline-secondary me-2">返回首页</a>
            <a href="add_model.php" class="btn btn-success">新增型号</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>型号ID</th>
                        <th>内部型号编码</th>
                        <th>官方名称</th>
                        <th>所属品牌ID</th>
                        <th>发布日期</th>
                        <th>上市指导价(元)</th>
                        <th>主图URL</th>
                        <th>产品简介</th>
                        <th>是否在售</th>
                        <th>创建时间</th>
                        <th>更新时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../config.php';

                    $stmt = $pdo->query("SELECT * FROM phone_model ORDER BY model_id DESC");
                    $models = $stmt->fetchAll();

                    if (count($models) === 0) {
                        echo "<tr><td colspan='12' class='text-center text-muted'>暂无型号数据</td></tr>";
                    } else {
                        foreach ($models as $model) {

                            $displayValues = [];
                            foreach ($model as $key => $value) {
                                $displayValues[$key] = $value ?? '-';
                            }

                            $isOnSale = $model['is_on_sale'] == 1 ?
                                "<span class='badge bg-success'>在售</span>" :
                                "<span class='badge bg-danger'>下架</span>";

                            echo "
                            <tr>
                                <td>{$displayValues['model_id']}</td>
                                <td>{$displayValues['model_code']}</td>
                                <td>{$displayValues['official_name']}</td>
                                <td>{$displayValues['brand_id']}</td>
                                <td>{$displayValues['release_date']}</td>
                                <td>{$displayValues['market_price']}</td>
                                <td>
                                    " . ($displayValues['main_image'] !== '-' ?
                                "<a href='{$displayValues['main_image']}' target='_blank'>查看</a>" :
                                '-') . "
                                </td>
                                <td>{$displayValues['description']}</td>
                                <td>{$isOnSale}</td>
                                <td>{$displayValues['created_time']}</td>
                                <td>{$displayValues['updated_time']}</td>
                                <td>

                                    <a href='edit_model.php?id={$model['model_id']}' class='btn btn-primary btn-sm me-1'>编辑</a>
                                    <button class='btn btn-danger btn-sm' onclick='deleteModel({$model['model_id']})'>删除</button>
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
        function deleteModel(modelId) {
            if (confirm("确定要删除该型号吗？删除后下属配置、SKU和合规信息也会被删除！")) {
                window.location.href = "delete_model.php?id=" + modelId;
            }
        }
    </script>
</body>

</html>