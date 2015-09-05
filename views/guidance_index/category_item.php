<?php if (!defined('ABSPATH')) die(); ?>

<li class="category-item <?=$type?>">
  <h2 class="category-title">
    <a href="<?=$url?>">
      <?=$title?>
    </a>
  </h2>

  <ul class="children-list">
    <?php foreach($children as $child): ?>
      <?php $this->view('guidance_index/child_item', $child); ?>
    <?php endforeach ?>
  </ul>
</li>
