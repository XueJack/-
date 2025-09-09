<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>品牌管理 - 新增</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>新增品牌</h2>
        <a href="list.php" class="btn btn-outline-secondary">返回列表</a>
    </div>

    <div class="card shadow-sm w-75 mx-auto">
        <div class="card-body">
            <form method="post" action="add_handler.php">
                <div class="mb-3">
                    <label for="brandName" class="form-label">品牌名称 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="brandName" name="brand_name" required
                        placeholder="如：某为、某果">
                </div>
                <div class="mb-3">
                    <label for="brandLogo" class="form-label">品牌LOGO URL</label>
                    <input type="url" class="form-control" id="brandLogo" name="brand_logo"
                        placeholder="如：https://xxx.com/logo.png">
                </div>
                <div class="mb-3">
                    <label for="origin" class="form-label">品牌产地 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="origin" name="origin" required placeholder="如：CN、UK">
                </div>
                <div class="mb-3">
                    <label class="form-label">是否启用 <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_enabled" id="enable" value="1" checked>
                        <label class="form-check-label" for="enable">启用</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_enabled" id="disable" value="0">
                        <label class="form-check-label" for="disable">禁用</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">提交新增</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>