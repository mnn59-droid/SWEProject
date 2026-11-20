<?php 
require_once __DIR__ . '/../src/bootstrap.php';

$summary = cartSummary();
if (empty($summary['items'])){
    header('Location: /cart.php');
    exit;
}
$errors = [];
$firstname = trim($_POST['firstname'] ?? '');
$lastname = trim($_POST['lastname'] ?? '');
$email = trim($_POST['email'] ?? '');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($firstname === ''){
        $errors['firstname'] = 'First name is required';
    } elseif (mb_strlen($firstname) < 2){
        $errors['firstname'] = 'First name must be at least 2 characters';
    }elseif (mb_strlen($firstname) > 50){
        $errors['firstname'] = 'First name must be less than 50 characters';
    }
    if($lastname === ''){
        $errors['lastname'] = 'Last name is required';
    }elseif (mb_strlen($lastname) < 2){
        $errors['lastname'] = 'Last name must be at least 2 characters';
    }elseif (mb_strlen($lastname) > 50){
        $errors['lastname'] = 'Last name must be less than 50 characters';
    }
    if($email === ''){
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email is invalid';
    }elseif(mb_strlen($email) > 100){
        $errors['email'] = 'Email must be less than 100 characters';
    }

}

$pageTitle = 'Checkout';
include __DIR__ . '/../templates/header.php';
?>
<div class="page">
    <h1 class="page-title">Checkout</h1>

    <div class="checkout-container">
        <form method="post" action="/checkout.php" class="checkout-form">
            <h2>Your details</h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" 
                    value= "<?php echo  e($firstname); ?>" required>
                    <?php if (isset($errors['firstname'])) { ?>
                        <p class="error"><?php echo e($errors['firstname']); ?></p>
                        <?php } ?>
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" 
                    value = "<?php echo e($lastname); ?>" required>
                    <?php if (isset($errors['lastname'])) { ?>
                        <p class="error"><?php echo e($errors['lastname']); ?></p>
                    <?php } ?>
                </div>
                </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" 
                value="<?php echo e($email); ?>" required>
                <?php if (isset($errors['email'])) { ?>
                    <p class="error"><?php echo e($errors['email']); ?></p>
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary checkout-btn">Place order</button>
        </form>
 
        
        <aside class="cart-summary">
    <h2>Order summary</h2>

    <?php foreach ($summary['items'] as $item) { ?>
        <div class="summary-item">
            <span><?php echo e($item['quantity']); ?> × <?php echo e($item['product']['product_name']); ?></span>
            <span><?php echo money($item['line_total']); ?></span>
        </div>
    <?php } ?>
    
        <div class="summary-item">
            <span>Subtotal</span>
            <span><?php echo money($summary['subtotal']); ?></span>
        </div>
        <div class="summary-item">
            <span>Tax (6.625%)</span>
            <span><?php echo money($summary['tax']); ?></span>
        </div>

    <div class="summary-total">
        <span>Total</span>
        <span><?php echo money($summary['total']); ?></span>
    </div>
</aside>    </div>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>