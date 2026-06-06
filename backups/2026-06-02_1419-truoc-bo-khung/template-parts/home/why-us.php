<?php
$features = [
    [
        'color' => 'teal',
        'title' => 'Worldwide recognized-quality Leadership Programs',
        'desc'  => 'The leading educational organization in Vietnam provides Emotional Intelligence (EQ) Leadership Training programs based on Harvard Business School and Oxford University\'s Leadership Frameworks.',
    ],
    [
        'color' => 'green',
        'title' => 'World-class Working Standard Vision',
        'desc'  => 'Our mission is to advance EQ Communication skills to a world-class standard for leaders and their team members.',
    ],
    [
        'color' => 'yellow',
        'title' => 'Practical Training Program Design',
        'desc'  => 'As skills need to be practiced to master them, the program will be designed with 80% of the training is to practice, discuss and get coaching directly based on real & practical case scenarios in business so that you can apply directly the gained knowledge to your daily work.',
    ],
    [
        'color' => 'orange',
        'title' => 'Long-term program to make real impacts',
        'desc'  => 'Long term follow-up & coaching (varied per program) by our coach/trainers and technology/AI after the training workshop to support them to build and develop their EQ Communication skills in life and at work.',
    ],
];
?>

<section class="why-us section" id="why-us">
  <div class="container">
    <h2 class="why-us__title">Why us?</h2>
    <p class="why-us__lead">We are distinguished from others because we provide:</p>
  </div>

  <div class="why-us__items">
    <?php foreach ($features as $f) : ?>
      <div class="why-us-item">
        <div class="why-us-item__title-box why-us-item__title-box--<?php echo esc_attr($f['color']); ?>">
          <?php echo esc_html($f['title']); ?>
        </div>
        <p class="why-us-item__desc"><?php echo esc_html($f['desc']); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>
