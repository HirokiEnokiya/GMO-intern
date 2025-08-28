<?php
class FormModel {
    
    public function validate($data) {
        $errors = [];
        
        if (empty($data['name'])) {
            $errors['name'] = 'お名前は必須です。';
        } elseif (strlen($data['name']) > 50) {
            $errors['name'] = 'お名前は50文字以内で入力してください。';
        }
        
        if (empty($data['email'])) {
            $errors['email'] = 'メールアドレスは必須です。';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '正しいメールアドレスを入力してください。';
        }
        
        if (empty($data['service'])) {
            $errors['service'] = 'サービスは必須です。';
        } elseif (!in_array($data['service'], ['conoha', 'onamae', 'tokutoku'])) {
            $errors['service'] = '正しいサービスを選択してください。';
        }
        
        if (empty($data['category'])) {
            $errors['category'] = 'カテゴリーは必須です。';
        } else {
            $validCategories = $this->getValidCategories($data['service'] ?? '');
            if (!in_array($data['category'], $validCategories)) {
                $errors['category'] = '正しいカテゴリーを選択してください。';
            }
        }
        
        
        if (!empty($data['plan'])) {
            $validPlans = $this->getValidPlans($data['service'] ?? '');
            foreach ($data['plan'] as $plan) {
                if (!in_array($plan, $validPlans)) {
                    $errors['plan'] = '正しいプランを選択してください。';
                    break;
                }
            }
        }

        if (empty($data['message'])) {
            $errors['message'] = 'お問い合わせ内容は必須です。';
        } elseif (strlen($data['message']) > 100) {
            $errors['message'] = '100文字以内で入力してください。';
        }
        
        return $errors;
    }
    
    private function getValidCategories($service) {
        $categories = [
            'conoha' => ['server', 'plan', 'payment', 'support'],
            'onamae' => ['domain_register', 'domain_transfer', 'dns', 'payment'],
            'tokutoku' => ['internet', 'speed', 'device', 'billing']
        ];
        
        return $categories[$service] ?? [];
    }
    
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

    public function sendEmail($data) {
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        
        // 設定ファイルから表示ラベルを取得
        $labels = include(__DIR__ . '/../config/labels.php');
        $serviceNames = $labels['services'];
        $categoryNames = $labels['categories'];
        
        $to = "admin@gmo-intern.com";
        $from = "system@gmo-intern.com";
        $subject = "【新規お問い合わせ】" . $data['name'] . "様より";
        
        $body = "新規お問い合わせが届きました。\n";
        $body .= "速やかに対応をお願いいたします。\n\n";
        $body .= "【お問い合わせ詳細】\n";
        $body .= "受信日時：" . date('Y年m月d日 H:i:s') . "\n";
        $body .= "お名前：" . $data['name'] . "\n";
        $body .= "メールアドレス：" . $data['email'] . "\n";
        $body .= "サービス：" . ($serviceNames[$data['service']] ?? $data['service']) . "\n";
        $body .= "カテゴリー：" . ($categoryNames[$data['category']] ?? $data['category']) . "\n";
        
        if (!empty($data['plan']) && is_array($data['plan'])) {
            $body .= "選択プラン：" . implode(', ', $data['plan']) . "\n";
        }
        
        $body .= "\n【お問い合わせ内容】\n";
        $body .= $data['message'] . "\n\n";
        $body .= "────────────────────────────\n";
        $body .= "※このメールは自動送信されています。\n";
        $body .= "お客様への返信は、上記メールアドレス宛に行ってください。\n";
        $body .= "────────────────────────────\n";
        
        // メール送信ログをファイルに記録
        $this->logEmailContent($to, $from, $subject, $body);
        
        // メール送信
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        
        return mb_send_mail($to, $subject, $body, $headers);
    }
    
    private function logEmailContent($to, $from, $subject, $body) {
        $logData = "=== メール送信ログ ===\n";
        $logData .= "送信日時: " . date('Y-m-d H:i:s') . "\n";
        $logData .= "宛先: {$to}\n";
        $logData .= "送信者: {$from}\n";
        $logData .= "件名: {$subject}\n";
        $logData .= "本文:\n{$body}\n";
        $logData .= "========================\n\n";
        
        // ログファイルに追記
        file_put_contents('data/email_log.txt', $logData, FILE_APPEND | LOCK_EX);
    }
}
?>
