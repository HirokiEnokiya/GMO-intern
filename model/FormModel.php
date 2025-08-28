<?php
class FormModel {
    
    // バリデーション
    public function validate($data) {
        $errors = [];
        
        // 名前のバリデーション
        if (empty($data['name'])) {
            $errors['name'] = 'お名前は必須です。';
        } elseif (strlen($data['name']) > 50) {
            $errors['name'] = 'お名前は50文字以内で入力してください。';
        }
        
        // メールアドレスのバリデーション
        if (empty($data['email'])) {
            $errors['email'] = 'メールアドレスは必須です。';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '正しいメールアドレスを入力してください。';
        }
        
        // サービスのバリデーション
        if (empty($data['service'])) {
            $errors['service'] = 'サービスは必須です。';
        } elseif (!in_array($data['service'], ['conoha', 'onamae', 'tokutoku'])) {
            $errors['service'] = '正しいサービスを選択してください。';
        }
        
        // カテゴリーのバリデーション
        if (empty($data['category'])) {
            $errors['category'] = 'カテゴリーは必須です。';
        } else {
            // サービスに応じたカテゴリーの検証
            $validCategories = $this->getValidCategories($data['service'] ?? '');
            if (!in_array($data['category'], $validCategories)) {
                $errors['category'] = '正しいカテゴリーを選択してください。';
            }
        }
        
        // メッセージのバリデーション
        if (empty($data['message'])) {
            $errors['message'] = 'メッセージは必須です。';
        } elseif (strlen($data['message']) > 500) {
            $errors['message'] = 'メッセージは500文字以内で入力してください。';
        }
        
        // プランのバリデーション（任意項目）
        if (!empty($data['plan'])) {
            $validPlans = $this->getValidPlans($data['service'] ?? '');
            foreach ($data['plan'] as $plan) {
                if (!in_array($plan, $validPlans)) {
                    $errors['plan'] = '正しいプランを選択してください。';
                    break;
                }
            }
        }
        
        return $errors;
    }
    
    // サービスごとの有効なカテゴリーを取得
    private function getValidCategories($service) {
        $categories = [
            'conoha' => ['server', 'plan', 'payment', 'support'],
            'onamae' => ['domain_register', 'domain_transfer', 'dns', 'payment'],
            'tokutoku' => ['internet', 'speed', 'device', 'billing']
        ];
        
        return $categories[$service] ?? [];
    }
    
    // サービスごとの有効なプランを取得
    private function getValidPlans($service) {
        $plans = [
            'conoha' => ['vps_512mb', 'vps_1gb', 'vps_2gb', 'wing_basic', 'wing_standard', 'wing_premium'],
            'onamae' => ['domain_com', 'domain_net', 'domain_org', 'domain_jp', 'ssl_certificate', 'whois_privacy'],
            'tokutoku' => ['fiber_100m', 'fiber_1g', 'wimax_unlimited', 'mobile_wifi', 'ipv6_option', 'security_option']
        ];
        
        return $plans[$service] ?? [];
    }
    
    // データ保存（実際のアプリケーションではデータベースに保存）
    public function save($data) {
        // ここでは簡単にファイルに保存
        $logData = date('Y-m-d H:i:s') . " - " . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
        
        // ログファイルに追記
        $result = file_put_contents('data/form_submissions.log', $logData, FILE_APPEND | LOCK_EX);
        
        return $result !== false;
    }
}
?>
