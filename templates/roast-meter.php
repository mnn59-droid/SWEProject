<?php
// Roast-level meter: five beans from light to dark.
// The page that includes this file must set $product first.
// Products without a roast level (e.g. drinking chocolate) show nothing.
if (!empty($product['roast_level'])) {
    $level = (int) $product['roast_level'];
    $label = roastLabel($level);
?>
<div class="roast-meter" role="img" aria-label="Roast level: <?php echo e($label); ?>, <?php echo $level; ?> of 5">
    <span class="roast-meter-label">Roast</span>
    <span class="roast-meter-beans" aria-hidden="true">
        <?php for ($i = 1; $i <= 5; $i++) { ?>
            <span class="bean bean-<?php echo $i; ?><?php echo $i <= $level ? ' is-filled' : ''; ?>"></span>
        <?php } ?>
    </span>
    <span class="roast-meter-text"><?php echo e($label); ?></span>
</div>
<?php } ?>