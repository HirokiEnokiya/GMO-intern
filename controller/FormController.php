<?php
require_once 'model/FormModel.php';

class FormController {
    private $model;
    
    public function __construct() {
        $this->model = new FormModel();
    }
    
    public function showInput() {
        $errors = $_SESSION['errors'] ?? [];
        $data = $_SESSION['form_data'] ?? [];
        
        unset($_SESSION['errors']);
        unset($_SESSION['form_data']);
        
        include 'view/input.php';
    }
    
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
            
            $errors = $this->model->validate($data);
            
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['form_data'] = $data;
                header('Location: index.php?action=input');
                exit;
            }
            
            $_SESSION['form_data'] = $data;
        } else {
            header('Location: index.php?action=input');
            exit;
        }
        
        include 'view/confirm.php';
    }
    
    public function complete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['form_data'])) {
            $data = $_SESSION['form_data'];
            
            $result = $this->model->save($data);
            
            if ($result) {
                unset($_SESSION['form_data']);
                include 'view/complete.php';
            } else {
                $_SESSION['errors'] = ['保存に失敗しました。もう一度お試しください。'];
                header('Location: index.php?action=input');
                exit;
            }

            $this->model->sendEmail($data);
        } else {
            header('Location: index.php?action=input');
            exit;
        }
    }
}
?>
