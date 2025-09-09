<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合规信息管理 - 列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>合规信息列表</h2>
        <div>
            <a href="../index.php" class="btn btn-outline-secondary me-2">返回首页</a>
            <a href="add_compliance.php" class="btn btn-success">新增合规信息</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>合规ID</th>
                        <th>关联型号ID</th>
                        <th>3C认证编号</th>
                        <th>进网许可证编号</th>
                        <th>保修期限（月）</th>
                        <th>保修范围说明</th>
                        <th>环保标准</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../config.php';

                    $stmt = $pdo->query("SELECT * FROM compliance_info ORDER BY compliance_id DESC");
                    $compliances = $stmt->fetchAll();

                    if (count($compliances) === 0) {
                        echo "<tr><td colspan='8' class='text-center text-muted'>暂无合规信息数据</td></tr>";
                    } else {
                        foreach ($compliances as $compliance) {

                            $displayValues = [];
                            foreach ($compliance as $key => $value) {
                                $displayValues[$key] = $value ?? '-';
                            }

                            echo "
                            <tr>
                                <td>{$displayValues['compliance_id']}</td>
                                <td>{$displayValues['model_id']}</td>
                                <td>{$displayValues['three_cert']}</td>
                                <td>{$displayValues['network_cert']}</td>
                                <td>{$displayValues['warranty_period']}</td>
                                <td>{$displayValues['warranty_scope']}</td>
                                <td>{$displayValues['environmental_std']}</td>
                                <td>

                                    <a href='edit_compliance.php?id={$compliance['compliance_id']}' class='btn btn-primary btn-sm me-1'>编辑</a>
                                    <button class='btn btn-danger btn-sm' onclick='deleteCompliance({$compliance['compliance_id']})'>删除</button>
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
        function deleteCompliance(complianceId) {
            if (confirm("确定要删除该合规信息吗？删除后将无法恢复！")) {
                window.location.href = "delete_compliance.php?id=" + complianceId;
            }
        }
    </script>
</body>

</html>