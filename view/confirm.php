<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 確認画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>入力内容の確認</h1>
        
        <div class="confirm-data">
            <div class="confirm-item">
                <div class="confirm-label">お名前</div>
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
                    $serviceLabels = [
                        'conoha' => 'ConoHa',
                        'onamae' => 'お名前.com',
                        'tokutoku' => 'とくとくBB'
                    ];
                    echo htmlspecialchars($serviceLabels[$_SESSION['form_data']['service']] ?? $_SESSION['form_data']['service'], ENT_QUOTES); 
                    ?>
                </div>
            </div>
            
            <div class="confirm-item">
                <div class="confirm-label">カテゴリー</div>
                <div class="confirm-value">
                    <?php 
                    $categoryLabels = [
                        'server' => 'サーバーについて',
                        'plan' => 'プランについて', 
                        'payment' => 'お支払いについて',
                        'support' => 'サポートについて',
                        'domain_register' => 'ドメイン登録について',
                        'domain_transfer' => 'ドメイン移管について',
                        'dns' => 'DNS設定について',
                        'internet' => 'インターネット接続について',
                        'speed' => '通信速度について',
                        'device' => 'デバイスについて',
                        'billing' => 'ご請求について'
                    ];
                    echo htmlspecialchars($categoryLabels[$_SESSION['form_data']['category']] ?? $_SESSION['form_data']['category'], ENT_QUOTES); 
                    ?>
                </div>
            </div>
            
            <?php if (!empty($_SESSION['form_data']['plan'])): ?>
            <div class="confirm-item">
                <div class="confirm-label">プラン</div>
                <div class="confirm-value">
                    <?php 
                    $planLabels = [
                        // ConoHa
                        'vps_512mb' => 'VPS 512MB',
                        'vps_1gb' => 'VPS 1GB',
                        'vps_2gb' => 'VPS 2GB',
                        'wing_basic' => 'WINGベーシック',
                        'wing_standard' => 'WINGスタンダード',
                        'wing_premium' => 'WINGプレミアム',
                        // お名前.com
                        'domain_com' => '.comドメイン',
                        'domain_net' => '.netドメイン',
                        'domain_org' => '.orgドメイン',
                        'domain_jp' => '.jpドメイン',
                        'ssl_certificate' => 'SSL証明書',
                        'whois_privacy' => 'Whoisプライバシー',
                        // とくとくBB
                        'fiber_100m' => '光回線 100Mbps',
                        'fiber_1g' => '光回線 1Gbps',
                        'wimax_unlimited' => 'WiMAX使い放題',
                        'mobile_wifi' => 'モバイルWiFi',
                        'ipv6_option' => 'IPv6オプション',
                        'security_option' => 'セキュリティオプション'
                    ];
                    $selectedPlans = [];
                    foreach ($_SESSION['form_data']['plan'] as $plan) {
                        $selectedPlans[] = $planLabels[$plan] ?? $plan;
                    }
                    echo htmlspecialchars(implode(', ', $selectedPlans), ENT_QUOTES); 
                    ?>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="confirm-item">
                <div class="confirm-label">お問い合わせ内容</div>
                <div class="confirm-value"><?php echo htmlspecialchars($_SESSION['form_data']['message'], ENT_QUOTES); ?></div>
            </div>
        </div>
        
        <p>上記の内容で送信してもよろしいですか？</p>
        
        <div class="button-group">
            <a href="index.php?action=input" class="btn btn-secondary">戻る</a>
            
            <form action="index.php?action=complete" method="POST" style="display: inline;">
                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</body>
</html>
