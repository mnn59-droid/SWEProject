<?php
// Each slide: small label, headline, text, button, image
$slides = [
    [
        'kicker' => 'Single origin',
        'title'  => 'Roasted to order, from named farms',
        'text'   => 'Small-batch coffees from Guatemala, Ethiopia, Colombia and beyond.',
        'link'   => '/?category=Single+Origin',
        'cta'    => 'Shop single origin',
        'image'  => 'img/products/drinking-chocolate.jpg',      
    ],
    [
        'kicker' => 'Find your roast',
        'title'  => 'Light, medium or dark?',
        'text'   => 'Every bag shows its roast level, so you know what you are getting.',
        'link'   => '/?sort=roast',
        'cta'    => 'Browse by roast',
        'image'  => 'img/products/vietnam-robusta-honey.jpg',      
    ],
    [
        'kicker' => 'Blends',
        'title'  => 'Everyday blends',
        'text'   => 'Balanced coffees for drip, French press and espresso.',
        'link'   => '/?category=Blends',
        'cta'    => 'Shop blends',
        'image'  => 'img/products/diner-roast-mug-bundle.jpg',      
    ],
    [
        'kicker' => 'Specialty',
        'title'  => 'Gifts and bundles',
        'text'   => 'Samplers, mug bundles and drinking chocolate for the coffee lover in your life.',
        'link'   => '/?category=Specialty',
        'cta'    => 'Shop specialty',
        'image'  => 'img/products/everyday-house-coffee.jpg',      
    ],
];
?>
<section class="hero" aria-label="Featured coffees">
  <div class="hero-track">
    <?php foreach ($slides as $slide) { ?>
      <div class="slide">
        <img src="/assets/<?= e($slide['image']) ?>" alt="" class="slide-img">
        <div class="slide-text">
          <span class="slide-kicker"><?= e($slide['kicker']) ?></span>
          <h2><?= e($slide['title']) ?></h2>
          <p><?= e($slide['text']) ?></p>
          <a href="<?= e($slide['link']) ?>" class="slide-cta"><?= e($slide['cta']) ?></a>
        </div>
      </div>
    <?php } ?>
  </div>

  <button type="button" class="hero-arrow hero-prev" aria-label="Previous slide">‹</button>
  <button type="button" class="hero-arrow hero-next" aria-label="Next slide">›</button>

  <div class="hero-dots">
    <?php foreach ($slides as $i => $slide) { ?>
      <button type="button" class="hero-dot <?= $i === 0 ? 'active' : '' ?>" aria-label="Go to slide <?= $i + 1 ?>"></button>
    <?php } ?>
  </div>
</section>