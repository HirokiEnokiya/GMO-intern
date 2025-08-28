<?php
require_once 'model/FormModel.php';

class FormController {
    private $model;
    
    public function __construct() {
        $this->model = new FormModel();
    }
    
    // 入力画面を表示
    public function showInput() {
        $errors = $_SESSION['errors'] ?? [];
        $data = $_SESSION['form_data'] ?? [];
        
        // エラーとデータをクリア
        unset($_SESSION['errors']);
        unset($_SESSION['form_data']);
        
        include 'view/input.php';
    }
    
    // 確認画面を表示
    public function showConfirm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'service' => $_POST['service'] ?? '',
                'category' => $_POST['category'] ?? '',
                'plan' => $_POST['plan'] ?? [],
                'message' => $_POST['message'] ?? ''
            ];
            
            // バリデーション
            $errors = $this->model->validate($data);
            
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['form_data'] = $data;
                header('Location: index.php?action=input');
                exit;
            }
            
            // セッションにデータを保存
            $_SESSION['form_data'] = $data;
        } else {
            // POSTでない場合は入力画面にリダイレクト
            header('Location: index.php?action=input');
            exit;
        }
        
        include 'view/confirm.php';
    }
    
    // 完了処理
    public function complete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['form_data'])) {
            $data = $_SESSION['form_data'];
            
            // データを保存（実際のアプリケーションではデータベースに保存）
            $result = $this->model->save($data);
            
            if ($result) {
                // 成功時はセッションをクリア
                unset($_SESSION['form_data']);
                include 'view/complete.php';
            } else {
                // 失敗時はエラーメッセージを設定して入力画面に戻る
                $_SESSION['errors'] = ['保存に失敗しました。もう一度お試しください。'];
                header('Location: index.php?action=input');
                exit;
            }
        } else {
            // 不正なアクセスの場合は入力画面にリダイレクト
            header('Location: index.php?action=input');
            exit;
        }
    }
}
?>
