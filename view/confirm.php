<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 確認画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    // 設定ファイルから表示ラベルを取得
    $labels = include(__DIR__ . '/../config/labels.php');
    $serviceLabels = $labels['services'];
    $categoryLabels = $labels['categories'];
    $planLabels = $labels['plans'];
    ?>
    
    <div class="container">
        <h1>お問い合わせフォーム</h1>
        <p>入力内容にお間違いないかご確認ください。</p>
        
        <div class="confirm-data">
            <div class="confirm-item">
                <div class="confirm-label">氏名</div>
                <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['name'], ENT_QUOTES); ?></div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">メールアドレス</div>
                <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['email'], ENT_QUOTES); ?></div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">サービス</div>
                <div class="confirm-value">
                    <?php 
                    echo htmlspecialchars($serviceLabels[$_SESSION['form_data']['service']] ?? $_SESSION['form_data']['service'], ENT_QUOTES); 
                    ?>
                </div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">カテゴリー</div>
                <div class="confirm-value">
                    <?php 
                    echo htmlspecialchars($categoryLabels[$_SESSION['form_data']['category']] ?? $_SESSION['form_data']['category'], ENT_QUOTES); 
                    ?>
                </div>
            </div>
            
            <?php if (!empty($_SESSION['form_data']['plan'])): ?>
            <div class="confirm-item">
                <div class="confirm-label">プラン</div>
                <div class="confirm-value">
                    <?php 
                    $selectedPlans = [];
                    foreach ($_SESSION['form_data']['plan'] as $plan) {
                        $selectedPlans[] = $planLabels[$plan] ?? $plan;
                    }
                    echo htmlspecialchars(implode('・', $selectedPlans), ENT_QUOTES); 
                    ?>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="confirm-item">
                <div class="confirm-label">お問い合わせ内容</div>
                <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['message'], ENT_QUOTES); ?></div>
            </div>
        </div>
        
        
        <div class="button-group">
            <a href="index.php?action=input" class="btn btn-secondary">入力画面に戻る</a>
            
            <form action="index.php?action=complete" method="POST" style="display: inline;">
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</body>
</html>
