<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 確認画面</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light-custom">
    <?php
    $labels = include(__DIR__ . '/../config/labels.php');
    $serviceLabels = $labels['services'];
    $categoryLabels = $labels['categories'];
    $planLabels = $labels['plans'];
    ?>
    
    <!-- ヘッダー -->
    <header class="custom-header py-4 mb-5 shadow-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="text-white m-0 fw-bold">お問い合わせフォーム</h1>
                </div>
            </div>
        </div>
    </header>
    
    <!-- メイン説明文 -->
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <p class="text-muted-custom fs-6 mb-0">入力内容にお間違いないかご確認ください。</p>
            </div>
        </div>
    </div>

    <!-- 確認内容 -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="bg-white rounded-3 shadow-sm p-4">
                    <h2 class="h4 mb-4 text-center text-dark fw-bold">入力内容の確認</h2>
                    
                    <!-- 氏名 -->
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">
                            氏名 <span class="required-label">必須</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['name'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    
                    <!-- メールアドレス -->
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">
                            メールアドレス <span class="required-label">必須</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['email'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    
                    <!-- サービス -->
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">
                            サービス <span class="required-label">必須</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php echo htmlspecialchars($serviceLabels[$_SESSION['form_data']['service']] ?? $_SESSION['form_data']['service'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    
                    <!-- カテゴリー -->
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">
                            カテゴリー <span class="required-label">必須</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php echo htmlspecialchars($categoryLabels[$_SESSION['form_data']['category']] ?? $_SESSION['form_data']['category'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    
                    <!-- プラン -->
                    <?php if (!empty($_SESSION['form_data']['plan'])): ?>
                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">プラン</label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php $selectedPlans = []; foreach ($_SESSION['form_data']['plan'] as $plan) { $selectedPlans[] = $planLabels[$plan] ?? $plan; } echo htmlspecialchars(implode('・', $selectedPlans), ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- お問い合わせ内容 -->
                    <div class="row mb-5">
                        <label class="col-sm-3 col-form-label">
                            お問い合わせ内容 <span class="required-label">必須</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['message'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    
                    <!-- ボタングループ -->
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                <a href="index.php?action=input" class="btn btn-custom-secondary">
                                    入力画面に戻る
                                </a>
                                
                                <form action="index.php?action=complete" method="POST" class="d-inline">
                                    <button type="submit" class="btn custom-btn">
                                        送信する
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
