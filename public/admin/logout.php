<?php 
require_once __DIR__ . '/../../src/bootstrap.php';
unset($_SESSION['admin_id']);
session_regenerate_id(true);
header('Location: /admin/login.php');
exit;

?>