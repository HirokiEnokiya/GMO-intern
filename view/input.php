<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 入力画面</title>
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
                <p class="text-muted-custom fs-6 mb-0">こちらは〇〇に関するお問い合わせフォームです。</p>
            </div>
        </div>
    </div>

    <!-- フォーム本体 -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="bg-white rounded-3 shadow-sm p-4">
                    <form action="index.php?action=confirm" method="POST" class="needs-validation" novalidate>
                        
                        <!-- 氏名フィールド -->
                        <div class="row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">
                                氏名 <span class="required-label">必須</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       placeholder="山田 太郎"
                                       value="<?php echo htmlspecialchars($data['name'] ?? '', ENT_QUOTES); ?>"
                                       class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>"
                                       required>
                                <?php if (isset($errors['name'])): ?>
                                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['name']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                
                        <!-- メールアドレスフィールド -->
                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">
                                メールアドレス <span class="required-label">必須</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="email" 
                                       id="email" 
                                       name="email"
                                       placeholder="mail@example.com" 
                                       value="<?php echo htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>"
                                       class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                                       required>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['email']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- サービス選択フィールド -->
                        <div class="row mb-4">
                            <label for="service" class="col-sm-3 col-form-label">
                                サービス <span class="required-label">必須</span>
                            </label>
                            <div class="col-sm-9">
                                <select name="service" id="service" 
                                        class="form-select <?php echo isset($errors['service']) ? 'is-invalid' : ''; ?>"
                                        required>
                                    <option value="">選択してください</option>
                                    <?php foreach ($serviceLabels as $value => $label): ?>
                                    <option value="<?php echo htmlspecialchars($value); ?>" 
                                            <?php echo (($data['service'] ?? '') === $value) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($label); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['service'])): ?>
                                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['service']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- カテゴリー選択フィールド -->
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label class="col-form-label">
                                    カテゴリー <span class="required-label">必須</span>
                                </label>
                            </div>
                            <div class="col-sm-9">
                                <fieldset class="p-3">
                                    <div class="radio-group" id="categoryOptions">
                                        <!-- JavaScriptで動的に生成 -->
                                    </div>
                                    <?php if (isset($errors['category'])): ?>
                                        <div class="text-danger mt-2 small"><?php echo htmlspecialchars($errors['category']); ?></div>
                                    <?php endif; ?>
                                </fieldset>
                            </div>
                        </div>
                        
                        <!-- プラン選択フィールド -->
                        <div class="row mb-4">
                            <div class="col-sm-3">
                                <label class="col-form-label">プラン</label>
                            </div>
                            <div class="col-sm-9">
                                <fieldset class="p-3">
                                    <div class="checkbox-group" id="planOptions">
                                        <!-- JavaScriptで動的に生成 -->
                                    </div>
                                    <?php if (isset($errors['plan'])): ?>
                                        <div class="text-danger mt-2 small"><?php echo htmlspecialchars($errors['plan']); ?></div>
                                    <?php endif; ?>
                                </fieldset>
                            </div>
                        </div>
                        
                        <!-- お問い合わせ内容フィールド -->
                        <div class="row mb-5">
                            <label for="message" class="col-sm-3 col-form-label">
                                お問い合わせ内容 <span class="required-label">必須</span>
                            </label>
                            <div class="col-sm-9">
                                <textarea id="message" 
                                          name="message" 
                                          rows="6"
                                          class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>"
                                          placeholder="お問い合わせ内容をご記入ください。"
                                          required><?php echo htmlspecialchars($data['message'] ?? '', ENT_QUOTES); ?></textarea>
                                <?php if (isset($errors['message'])): ?>
                                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['message']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- 送信ボタン -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <div class="text-center">
                                    <button type="submit" class="btn custom-btn">
                                        確認画面へ進む
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // データ定義
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

        // 現在の値
        const currentCategory = '<?php echo htmlspecialchars($data['category'] ?? '', ENT_QUOTES); ?>';
        const currentPlans = <?php echo json_encode($data['plan'] ?? []); ?>;

        /**
         * カテゴリーオプションを更新
         * @param {string} service - 選択されたサービス
         */
        function updateCategoryOptions(service) {
            const categoryContainer = document.getElementById('categoryOptions');
            categoryContainer.innerHTML = '';

            if (service && categoryOptions[service]) {
                categoryOptions[service].forEach((option, index) => {
                    // フォームチェック要素の作成
                    const formCheck = document.createElement('div');
                    formCheck.className = 'form-check mb-2';

                    // ラジオ入力の作成
                    const radioInput = document.createElement('input');
                    radioInput.type = 'radio';
                    radioInput.className = 'form-check-input';
                    radioInput.id = `category_${option.value}`;
                    radioInput.name = 'category';
                    radioInput.value = option.value;
                    
                    // 現在の値または最初の項目を選択
                    if (currentCategory === option.value || (!currentCategory && index === 0)) {
                        radioInput.checked = true;
                    }

                    // ラベルの作成
                    const radioLabel = document.createElement('label');
                    radioLabel.className = 'form-check-label';
                    radioLabel.htmlFor = `category_${option.value}`;
                    radioLabel.textContent = option.label;

                    // 要素の組み立て
                    formCheck.appendChild(radioInput);
                    formCheck.appendChild(radioLabel);
                    categoryContainer.appendChild(formCheck);
                });
            } else {
                // サービス未選択時のメッセージ
                const alertDiv = document.createElement('div');
                alertDiv.className = 'text-muted fst-italic small';
                alertDiv.innerHTML = '<i class="bi bi-info-circle me-1"></i>サービスを選択してください';
                categoryContainer.appendChild(alertDiv);
            }
        }

        /**
         * プランオプションを更新
         * @param {string} service - 選択されたサービス
         */
        function updatePlanOptions(service) {
            const planContainer = document.getElementById('planOptions');
            planContainer.innerHTML = '';

            if (service && planOptions[service]) {
                planOptions[service].forEach((option) => {
                    // フォームチェック要素の作成
                    const formCheck = document.createElement('div');
                    formCheck.className = 'form-check mb-2';

                    // チェックボックス入力の作成
                    const checkboxInput = document.createElement('input');
                    checkboxInput.type = 'checkbox';
                    checkboxInput.className = 'form-check-input';
                    checkboxInput.id = `plan_${option.value}`;
                    checkboxInput.name = 'plan[]';
                    checkboxInput.value = option.value;
                    
                    // 現在の値をチェック
                    if (currentPlans.includes(option.value)) {
                        checkboxInput.checked = true;
                    }

                    // ラベルの作成
                    const checkboxLabel = document.createElement('label');
                    checkboxLabel.className = 'form-check-label';
                    checkboxLabel.htmlFor = `plan_${option.value}`;
                    checkboxLabel.textContent = option.label;

                    // 要素の組み立て
                    formCheck.appendChild(checkboxInput);
                    formCheck.appendChild(checkboxLabel);
                    planContainer.appendChild(formCheck);
                });
            } else {
                // サービス未選択時のメッセージ
                const alertDiv = document.createElement('div');
                alertDiv.className = 'text-muted fst-italic small';
                alertDiv.innerHTML = '<i class="bi bi-info-circle me-1"></i>サービスを選択してください';
                planContainer.appendChild(alertDiv);
            }
        }

        /**
         * フォームバリデーション
         */
        function initializeFormValidation() {
            const forms = document.querySelectorAll('.needs-validation');
            
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }

        // DOM読み込み完了時の初期化
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            
            // 初期表示の設定
            updateCategoryOptions(serviceSelect.value);
            updatePlanOptions(serviceSelect.value);
            
            // サービス変更時のイベントリスナー
            serviceSelect.addEventListener('change', function() {
                updateCategoryOptions(this.value);
                updatePlanOptions(this.value);
            });

            // フォームバリデーションの初期化
            initializeFormValidation();

            // スムーススクロールの有効化（エラー箇所への移動用）
            if (window.location.hash) {
                const element = document.querySelector(window.location.hash);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    </script>
    
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
