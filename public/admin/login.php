<?php
require_once __DIR__ . '/../../src/bootstrap.php';

$errors = [];
$email = trim($_POST['email'] ?? '');


if($_SERVER['REQUEST_METHOD']==='POST'){
    verifyCsrf();
    $password = $_POST['password'] ?? '';

    $stmt = db() -> prepare('SELECT id, password_hash FROM admins WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $admin = $stmt->fetch();

    if($admin !== false && password_verify($password, $admin['password_hash'])){
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: /admin/orders.php');
        exit;
    }
    $errors['login'] = 'Invalid email or password.';
}
?>
<?php require __DIR__ . '/../../templates/header.php'; ?>
<div class="page">

<h1>Admin login</h1>
<?php if (isset($errors['login'])) { ?>
    <p class="error"><?= e($errors['login']) ?></p>
    <?php } ?>
    <form method="post">
        <?= csrfField() ?>
        <label> Email <input type="email" name="email" value="<?= e($email) ?>" required></label>
        <label>Password <input type="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
</div>
 <?php require __DIR__ . '/../../templates/footer.php'; ?>
