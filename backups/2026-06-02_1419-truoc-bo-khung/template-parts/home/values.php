<?php
$values = [
    ['title' => 'Leadership',   'desc' => 'We are leading in NEW leadership mindset.'],
    ['title' => 'Respect',      'desc' => 'We respect people\'s stories, values and backgrounds.'],
    ['title' => 'Inclusiveness','desc' => 'We strive to offer skills to anyone who has potential to be great leaders for great purpose.'],
    ['title' => 'Authenticity', 'desc' => 'What we do is based on our true values.'],
    ['title' => 'Optimism',     'desc' => 'We are optimistic about the better futures created by value-driven leaders.'],
];
?>

<section class="values section" id="values">
  <div class="container">
    <h2 class="values__title">Our<br>Values</h2>

    <div class="values__grid">
      <?php foreach ($values as $v) : ?>
        <div class="value-card">
          <h3 class="value-card__title"><?php echo esc_html($v['title']); ?></h3>
          <p class="value-card__desc"><?php echo esc_html($v['desc']); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
