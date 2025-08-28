<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 入力画面</title>
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
                    <?php foreach ($serviceLabels as $value => $label): ?>
                    <option value="<?php echo htmlspecialchars($value); ?>" <?php echo (($data['service'] ?? '') === $value) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($label); ?>
                    </option>
                    <?php endforeach; ?>
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
        // PHPの設定ファイルからJavaScript用データを生成
        const categoryOptions = {
            <?php 
            $categoryValidation = [
                'conoha' => ['server', 'plan', 'payment', 'support'],
                'onamae' => ['domain_register', 'domain_transfer', 'dns', 'payment'],
                'tokutoku' => ['internet', 'speed', 'device', 'billing']
            ];
            
            foreach ($categoryValidation as $service => $categories): ?>
            '<?php echo $service; ?>': [
                <?php foreach ($categories as $category): ?>
                { value: '<?php echo $category; ?>', label: '<?php echo addslashes($categoryLabels[$category] ?? $category); ?>' },
                <?php endforeach; ?>
            ],
            <?php endforeach; ?>
        };

        const planOptions = {
            <?php 
            $planValidation = [
                'conoha' => ['vps_512mb', 'vps_1gb', 'vps_2gb', 'wing_basic', 'wing_standard', 'wing_premium'],
                'onamae' => ['domain_com', 'domain_net', 'domain_org', 'domain_jp', 'ssl_certificate', 'whois_privacy'],
                'tokutoku' => ['fiber_100m', 'fiber_1g', 'wimax_unlimited', 'mobile_wifi', 'ipv6_option', 'security_option']
            ];
            
            foreach ($planValidation as $service => $plans): ?>
            '<?php echo $service; ?>': [
                <?php foreach ($plans as $plan): ?>
                { value: '<?php echo $plan; ?>', label: '<?php echo addslashes($planLabels[$plan] ?? $plan); ?>' },
                <?php endforeach; ?>
            ],
            <?php endforeach; ?>
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
