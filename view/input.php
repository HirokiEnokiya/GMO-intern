<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 入力画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>お問い合わせフォーム</h1>
        
        <form action="index.php?action=confirm" method="POST">
            <div class="form-group">
                <!-- TODO: 必須マークを修正 -->
                <label for="name">氏名 <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="<?php echo htmlspecialchars($data['name'] ?? '', ENT_QUOTES); ?>"
                       class="<?php echo isset($errors['name']) ? 'error-border' : ''; ?>">
                <?php if (isset($errors['name'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errors['name']); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">メールアドレス <span class="required">*</span></label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?php echo htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>"
                       class="<?php echo isset($errors['email']) ? 'error-border' : ''; ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="service">サービス <span class="required">*</span></label>
                <select name="service" id="service" class="<?php echo isset($errors['service']) ? 'error-border' : ''; ?>">
                    <option value="">選択してください</option>
                    <option value="conoha" <?php echo (($data['service'] ?? '') === 'conoha') ? 'selected' : ''; ?>>ConoHa</option>
                    <option value="onamae" <?php echo (($data['service'] ?? '') === 'onamae') ? 'selected' : ''; ?>>お名前.com</option>
                    <option value="tokutoku" <?php echo (($data['service'] ?? '') === 'tokutoku') ? 'selected' : ''; ?>>とくとくBB</option>
                </select>
                <?php if (isset($errors['service'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errors['service']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <fieldset>
                    <legend>カテゴリー <span class="required">*</span></legend>
                    <div class="radio-group" id="categoryOptions">
                    </div>
                    <?php if (isset($errors['category'])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors['category']); ?></div>
                    <?php endif; ?>
                </fieldset>
            </div>
            
            <div class="form-group">
                <fieldset>
                    <legend>プラン</legend>
                    <div class="checkbox-group" id="planOptions">
                        <!-- JavaScriptで動的に生成される -->
                    </div>
                    <?php if (isset($errors['plan'])): ?>
                        <div class="error"><?php echo htmlspecialchars($errors['plan']); ?></div>
                    <?php endif; ?>
                </fieldset>
            </div>
            
            
            <div class="form-group">
                <label for="message">お問い合わせ内容 <span class="required">*</span></label>
                <textarea id="message" 
                          name="message" 
                          rows="6"
                          class="<?php echo isset($errors['message']) ? 'error-border' : ''; ?>"
                          placeholder="お問い合わせ内容をご記入ください"><?php echo htmlspecialchars($data['message'] ?? '', ENT_QUOTES); ?></textarea>
                <?php if (isset($errors['message'])): ?>
                    <div class="error"><?php echo htmlspecialchars($errors['message']); ?></div>
                <?php endif; ?>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn">確認画面へ進む</button>
            </div>
        </form>
    </div>

    <script>
        const categoryOptions = {
            'conoha': [
                { value: 'server', label: 'サーバーについて' },
                { value: 'plan', label: 'プランについて' },
                { value: 'payment', label: 'お支払いについて' },
                { value: 'support', label: 'サポートについて' }
            ],
            'onamae': [
                { value: 'domain_register', label: 'ドメイン登録について' },
                { value: 'domain_transfer', label: 'ドメイン移管について' },
                { value: 'dns', label: 'DNS設定について' },
                { value: 'payment', label: 'お支払いについて' }
            ],
            'tokutoku': [
                { value: 'internet', label: 'インターネット接続について' },
                { value: 'speed', label: '通信速度について' },
                { value: 'device', label: 'デバイスについて' },
                { value: 'billing', label: 'ご請求について' }
            ]
        };

        const planOptions = {
            'conoha': [
                { value: 'vps_512mb', label: 'VPS 512MB' },
                { value: 'vps_1gb', label: 'VPS 1GB' },
                { value: 'vps_2gb', label: 'VPS 2GB' },
                { value: 'wing_basic', label: 'WINGベーシック' },
                { value: 'wing_standard', label: 'WINGスタンダード' },
                { value: 'wing_premium', label: 'WINGプレミアム' }
            ],
            'onamae': [
                { value: 'domain_com', label: '.comドメイン' },
                { value: 'domain_net', label: '.netドメイン' },
                { value: 'domain_org', label: '.orgドメイン' },
                { value: 'domain_jp', label: '.jpドメイン' },
                { value: 'ssl_certificate', label: 'SSL証明書' },
                { value: 'whois_privacy', label: 'Whoisプライバシー' }
            ],
            'tokutoku': [
                { value: 'fiber_100m', label: '光回線 100Mbps' },
                { value: 'fiber_1g', label: '光回線 1Gbps' },
                { value: 'wimax_unlimited', label: 'WiMAX使い放題' },
                { value: 'mobile_wifi', label: 'モバイルWiFi' },
                { value: 'ipv6_option', label: 'IPv6オプション' },
                { value: 'security_option', label: 'セキュリティオプション' }
            ]
        };

        // 現在選択されている値を保存（PHP側から取得）
        const currentCategory = '<?php echo htmlspecialchars($data['category'] ?? '', ENT_QUOTES); ?>';
        const currentPlans = <?php echo json_encode($data['plan'] ?? []); ?>;

        // カテゴリーオプションを生成する関数
        function updateCategoryOptions(service) {
            const categoryContainer = document.getElementById('categoryOptions');
            categoryContainer.innerHTML = '';

            if (service && categoryOptions[service]) {
                categoryOptions[service].forEach((option, index) => {
                    const radioItem = document.createElement('div');
                    radioItem.className = 'radio-item';

                    const radioInput = document.createElement('input');
                    radioInput.type = 'radio';
                    radioInput.id = 'category_' + option.value;
                    radioInput.name = 'category';
                    radioInput.value = option.value;
                    
                    // 最初のオプションをデフォルト選択、または以前の選択値を復元
                    if (currentCategory === option.value || (!currentCategory && index === 0)) {
                        radioInput.checked = true;
                    }

                    const radioLabel = document.createElement('label');
                    radioLabel.htmlFor = 'category_' + option.value;
                    radioLabel.textContent = option.label;

                    radioItem.appendChild(radioInput);
                    radioItem.appendChild(radioLabel);
                    categoryContainer.appendChild(radioItem);
                });
            } else {
                // サービスが選択されていない場合のメッセージ
                const messageDiv = document.createElement('div');
                messageDiv.style.color = '#666';
                messageDiv.style.fontStyle = 'italic';
                messageDiv.textContent = 'まずサービスを選択してください';
                categoryContainer.appendChild(messageDiv);
            }
        }

        // プランオプションを生成する関数
        function updatePlanOptions(service) {
            const planContainer = document.getElementById('planOptions');
            planContainer.innerHTML = '';

            if (service && planOptions[service]) {
                planOptions[service].forEach((option) => {
                    const checkboxItem = document.createElement('div');
                    checkboxItem.className = 'checkbox-item';

                    const checkboxInput = document.createElement('input');
                    checkboxInput.type = 'checkbox';
                    checkboxInput.id = 'plan_' + option.value;
                    checkboxInput.name = 'plan[]';
                    checkboxInput.value = option.value;
                    
                    // 以前の選択値を復元
                    if (currentPlans.includes(option.value)) {
                        checkboxInput.checked = true;
                    }

                    const checkboxLabel = document.createElement('label');
                    checkboxLabel.htmlFor = 'plan_' + option.value;
                    checkboxLabel.textContent = option.label;

                    checkboxItem.appendChild(checkboxInput);
                    checkboxItem.appendChild(checkboxLabel);
                    planContainer.appendChild(checkboxItem);
                });
            } else {
                // サービスが選択されていない場合のメッセージ
                const messageDiv = document.createElement('div');
                messageDiv.style.color = '#666';
                messageDiv.style.fontStyle = 'italic';
                messageDiv.textContent = 'まずサービスを選択してください';
                planContainer.appendChild(messageDiv);
            }
        }

        // ページ読み込み時の初期化
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            
            // 初期表示時にカテゴリーとプランを設定
            updateCategoryOptions(serviceSelect.value);
            updatePlanOptions(serviceSelect.value);
            
            // サービス変更時のイベントリスナー
            serviceSelect.addEventListener('change', function() {
                updateCategoryOptions(this.value);
                updatePlanOptions(this.value);
            });
        });
    </script>
</body>
</html>
