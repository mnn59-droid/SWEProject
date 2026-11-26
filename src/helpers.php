<?php

function e($value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function money($amount): string
{
    return '$' . number_format($amount, 2);
}
function requireAdmin(): void {
    if(empty($_SESSION['admin_id'])){
        header('Location: /admin/login.php');
        exit;
    }
}
function roastLabel(int $level): string{
    $labels = [1 => 'Light',2 => 'Light-medium',3 => 'Medium', 4=> 'Medium-dark', 5 =>'Dark'];
    return $labels[$level] ?? '';
}
function csrfToken(): string{
    if(empty($_SESSION['csrf'])){
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrfField(): string{
    return '<input type="hidden" name="csrf" value="'.e(csrfToken()).'">';
}
function verifyCsrf(): void{
    $sent = $_POST['csrf'] ?? '';
    if(!hash_equals(csrfToken(), $sent)){
        http_response_code(403);
        exit('Invalid form submission. Please go back and try again.');
    }
}
?>