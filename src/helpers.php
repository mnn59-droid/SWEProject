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
?>