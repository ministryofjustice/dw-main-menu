<?php if (!defined('ABSPATH')) die(); ?>

<li class="category-item <?=$is_current? 'current' : 'not-current' ?>">
  <a class="category-link" href="<?=$url?>">
    <?=$title?>
  </a>

  <ul class="children-list">
    <?php foreach($children as $child): ?>
      <?php $this->view('child_item', $child); ?>
    <?php endforeach ?>
  </ul>
</li>
