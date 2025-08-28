<?php
return [
    'services' => [
        'conoha' => 'ConoHa',
        'onamae' => 'お名前.com',
        'tokutoku' => 'とくとくBB'
    ],
    
    'categories' => [
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
    ],
    
    'plans' => [
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
    ]
];
