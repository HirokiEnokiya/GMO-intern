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
    <style>
        :root {
            --primary-color: #3498db;
        }
        
        * {
            font-family: 'Noto Sans JP', sans-serif;
        }
        
        label {
            font-weight: 700;
        }
        
        /* 選択肢のラベルスタイル */
        .form-check-label {
            font-weight: 430;
            color: #383838;
            font-size: 0.95rem;
        }
        
        /* プレースホルダーのスタイル - より具体的なセレクター */
        .form-control::placeholder,
        .form-select::placeholder {
            color: #adb5bd !important;
            opacity: 0.6 !important;
        }
        
        .form-control::-webkit-input-placeholder,
        .form-select::-webkit-input-placeholder {
            color: #adb5bd !important;
            opacity: 0.6 !important;
        }
        
        .form-control::-moz-placeholder,
        .form-select::-moz-placeholder {
            color: #adb5bd !important;
            opacity: 0.6 !important;
        }
        
        .form-control:-ms-input-placeholder,
        .form-select:-ms-input-placeholder {
            color: #adb5bd !important;
            opacity: 0.6 !important;
        }
               
        .custom-header {
            background-color: var(--primary-color);
        }
        
        .custom-btn {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }
        
        .custom-btn:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            color: white;
        }
        
        .custom-btn:focus {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        /* カスタムラジオボタンのスタイル */
        .form-check-input[type="radio"] {
            border-radius: 50%;
            border: 2px solid #ddd;
            background-color: white;
            width: 1.25em;
            height: 1.25em;
            margin-top: 0.125em;
            transition: all 0.15s ease-in-out;
        }
        
        .form-check-input[type="radio"]:checked {
            background-color: white;
            background-image: radial-gradient(circle, var(--primary-color) 48%, transparent 48%);
            box-shadow: none;
        }
        
        .form-check-input[type="radio"]:focus {
            /* bootstrapのスタイルの上書き */
            box-shadow: none;
            outline: none;
        }
        
        .form-check-input[type="radio"]:hover {
        }
        
        /* カスタムチェックボックスのスタイル */
        .form-check-input[type="checkbox"] {
            border-radius: 0.25em;
            border: 2px solid #ddd;
            background-color: white;
            width: 1.25em;
            height: 1.25em;
            margin-top: 0.125em;
            transition: all 0.15s ease-in-out;
        }
        
        .form-check-input[type="checkbox"]:checked {
            background-color: white;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%233498db' stroke-linecap='round' stroke-linejoin='round' stroke-width='5' d='m4 10 3 3 8-8'/%3e%3c/svg%3e");
            box-shadow: none;
        }
        
        .form-check-input[type="checkbox"]:focus {
            box-shadow: none;
            outline: none;
        }
        
        /* ラジオボタンとチェックボックスのラベル間隔調整 */
        .form-check {
            margin-bottom: 0.5rem;
        }
        
        .form-check-input {
            margin-right: 0.5rem;
        }
        
    </style>
</head>
<body>
    <?php
    $labels = include(__DIR__ . '/../config/labels.php');
    $serviceLabels = $labels['services'];
    $categoryLabels = $labels['categories'];
    $planLabels = $labels['plans'];
    ?>
    
    <div class="w-100 py-4 mb-5 custom-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <h1 class="text-white m-0">お問い合わせフォーム</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-8 col-md-10">
                <p class="text-muted text-start mb-5">こちらは〇〇に関するお問い合わせフォームです。</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <form action="index.php?action=confirm" method="POST">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label">氏名 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   placeholder="山田 太郎"
                                   value="<?php echo htmlspecialchars($data['name'] ?? '', ENT_QUOTES); ?>"
                                   class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>">
                            <?php if (isset($errors['name'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['name']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
            
            <div class="mb-3 row">
                <label for="email" class="col-sm-3 col-form-label">メールアドレス <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="email" 
                           id="email" 
                           name="email"
                           placeholder="mail@example.com" 
                           value="<?php echo htmlspecialchars($data['email'] ?? '', ENT_QUOTES); ?>"
                           class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($errors['email']); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="service" class="col-sm-3 col-form-label">サービス <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="service" id="service" class="form-select <?php echo isset($errors['service']) ? 'is-invalid' : ''; ?>">
                        <option value="">選択してください</option>
                        <?php foreach ($serviceLabels as $value => $label): ?>
                        <option value="<?php echo htmlspecialchars($value); ?>" <?php echo (($data['service'] ?? '') === $value) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($label); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['service'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($errors['service']); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-3">
                    <label class="col-form-label">カテゴリー <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                    <fieldset class="border border-light p-3 rounded">
                        <div class="radio-group" id="categoryOptions">
                        </div>
                        <?php if (isset($errors['category'])): ?>
                            <div class="text-danger mt-2"><?php echo htmlspecialchars($errors['category']); ?></div>
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div>
            
            <div class="mb-3 row">
                <div class="col-sm-3">
                    <label class="col-form-label">プラン</label>
                </div>
                <div class="col-sm-9">
                    <fieldset class="border border-light p-3 rounded">
                        <div class="checkbox-group" id="planOptions">
                        </div>
                        <?php if (isset($errors['plan'])): ?>
                            <div class="text-danger mt-2"><?php echo htmlspecialchars($errors['plan']); ?></div>
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div>
            
            <div class="mb-4 row">
                <label for="message" class="col-sm-3 col-form-label">お問い合わせ内容 <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <textarea id="message" 
                              name="message" 
                              rows="6"
                              class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>"
                              placeholder="お問い合わせ内容をご記入ください。"><?php echo htmlspecialchars($data['message'] ?? '', ENT_QUOTES); ?></textarea>
                    <?php if (isset($errors['message'])): ?>
                        <div class="invalid-feedback"><?php echo htmlspecialchars($errors['message']); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg fw-bold custom-btn">確認画面へ進む</button>
                    </div>
                </div>
            </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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

        const currentCategory = '<?php echo htmlspecialchars($data['category'] ?? '', ENT_QUOTES); ?>';
        const currentPlans = <?php echo json_encode($data['plan'] ?? []); ?>;

        function updateCategoryOptions(service) {
            const categoryContainer = document.getElementById('categoryOptions');
            categoryContainer.innerHTML = '';

            if (service && categoryOptions[service]) {
                categoryOptions[service].forEach((option, index) => {
                    const radioItem = document.createElement('div');
                    radioItem.className = 'form-check';

                    const radioInput = document.createElement('input');
                    radioInput.type = 'radio';
                    radioInput.className = 'form-check-input';
                    radioInput.id = 'category_' + option.value;
                    radioInput.name = 'category';
                    radioInput.value = option.value;
                    
                    if (currentCategory === option.value || (!currentCategory && index === 0)) {
                        radioInput.checked = true;
                    }

                    const radioLabel = document.createElement('label');
                    radioLabel.className = 'form-check-label';
                    radioLabel.htmlFor = 'category_' + option.value;
                    radioLabel.textContent = option.label;

                    radioItem.appendChild(radioInput);
                    radioItem.appendChild(radioLabel);
                    categoryContainer.appendChild(radioItem);
                });
            } else {
                // サービスが選択されていない場合のメッセージ
                const messageDiv = document.createElement('div');
                messageDiv.className = 'text-muted fst-italic';
                messageDiv.textContent = 'まずサービスを選択してください';
                categoryContainer.appendChild(messageDiv);
            }
        }

        function updatePlanOptions(service) {
            const planContainer = document.getElementById('planOptions');
            planContainer.innerHTML = '';

            if (service && planOptions[service]) {
                planOptions[service].forEach((option) => {
                    const checkboxItem = document.createElement('div');
                    checkboxItem.className = 'form-check';

                    const checkboxInput = document.createElement('input');
                    checkboxInput.type = 'checkbox';
                    checkboxInput.className = 'form-check-input';
                    checkboxInput.id = 'plan_' + option.value;
                    checkboxInput.name = 'plan[]';
                    checkboxInput.value = option.value;
                    
                    if (currentPlans.includes(option.value)) {
                        checkboxInput.checked = true;
                    }

                    const checkboxLabel = document.createElement('label');
                    checkboxLabel.className = 'form-check-label';
                    checkboxLabel.htmlFor = 'plan_' + option.value;
                    checkboxLabel.textContent = option.label;

                    checkboxItem.appendChild(checkboxInput);
                    checkboxItem.appendChild(checkboxLabel);
                    planContainer.appendChild(checkboxItem);
                });
            } else {
                // サービスが選択されていない場合のメッセージ
                const messageDiv = document.createElement('div');
                messageDiv.className = 'text-muted fst-italic';
                messageDiv.textContent = 'まずサービスを選択してください';
                planContainer.appendChild(messageDiv);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            
            updateCategoryOptions(serviceSelect.value);
            updatePlanOptions(serviceSelect.value);
            
            serviceSelect.addEventListener('change', function() {
                updateCategoryOptions(this.value);
                updatePlanOptions(this.value);
            });
        });
    </script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
