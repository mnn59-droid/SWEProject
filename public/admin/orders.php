<?php
require_once __DIR__ . '/../../src/bootstrap.php';
requireAdmin();


?>
<h1> Orders</h1>
<p>Logged in as admin #<?= e((string) $_SESSION['admin_id']) ?></p> 
<a href="/admin/logout.php">Logout</a>