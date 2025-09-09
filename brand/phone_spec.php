<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手机配置管理 - 列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>手机配置列表</h2>
        <div>
            <a href="../index.php" class="btn btn-outline-secondary me-2">返回首页</a>
            <a href="add_spec.php" class="btn btn-success">新增配置</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>配置ID</th>
                        <th>关联型号ID</th>
                        <th>处理器型号</th>
                        <th>屏幕尺寸(英寸)</th>
                        <th>屏幕分辨率</th>
                        <th>屏幕刷新率(Hz)</th>
                        <th>运行内存(GB)</th>
                        <th>机身存储(GB)</th>
                        <th>电池容量(mAh)</th>
                        <th>充电功率(W)</th>
                        <th>后置摄像头</th>
                        <th>前置摄像头</th>
                        <th>操作系统</th>
                        <th>网络类型</th>
                        <th>机身重量(g)</th>
                        <th>机身材质</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../config.php';

                    $stmt = $pdo->query("SELECT * FROM phone_spec ORDER BY spec_id DESC");
                    $specs = $stmt->fetchAll();

                    if (count($specs) === 0) {
                        echo "<tr><td colspan='17' class='text-center text-muted'>暂无配置数据</td></tr>";
                    } else {
                        foreach ($specs as $spec) {
                            $displayValues = [];
                            foreach ($spec as $key => $value) {
                                $displayValues[$key] = $value ?? '-';
                            }

                            echo "
                            <tr>
                                <td>{$displayValues['spec_id']}</td>
                                <td>{$displayValues['model_id']}</td>
                                <td>{$displayValues['cpu_model']}</td>
                                <td>{$displayValues['screen_size']}</td>
                                <td>{$displayValues['screen_resolution']}</td>
                                <td>{$displayValues['screen_refresh']}</td>
                                <td>{$displayValues['ram_capacity']}</td>
                                <td>{$displayValues['rom_capacity']}</td>
                                <td>{$displayValues['battery_capacity']}</td>
                                <td>{$displayValues['charge_power']}</td>
                                <td>{$displayValues['rear_camera']}</td>
                                <td>{$displayValues['front_camera']}</td>
                                <td>{$displayValues['os_version']}</td>
                                <td>{$displayValues['network_type']}</td>
                                <td>{$displayValues['body_weight']}</td>
                                <td>{$displayValues['body_material']}</td>
                                <td>
                                    <a href='edit_spec.php?id={$spec['spec_id']}' class='btn btn-primary btn-sm me-1'>编辑</a>
                                    <button class='btn btn-danger btn-sm' onclick='deleteSpec({$spec['spec_id']})'>删除</button>
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
        function deleteSpec(specId) {
            if (confirm("确定要删除该配置吗？删除后将无法恢复！")) {
                window.location.href = "delete_spec.php?id=" + specId;
            }
        }
    </script>
</body>

</html>