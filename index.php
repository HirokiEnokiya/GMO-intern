<?php
session_start();

// リクエストパラメータを取得
$action = $_GET['action'] ?? 'input';

// コントローラーを読み込み
require_once 'controller/FormController.php';

// コントローラーのインスタンス作成
$controller = new FormController();

// アクションに応じた処理を実行
switch ($action) {
    case 'input':
        $controller->showInput();
        break;
    case 'confirm':
        $controller->showConfirm();
        break;
    case 'complete':
        $controller->complete();
        break;
    default:
        $controller->showInput();
        break;
}
?>