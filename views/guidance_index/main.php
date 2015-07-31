<?php if (!defined('ABSPATH')) die(); ?>

<div style="clear: both">
</div>
<div class="guidance-index-widget">
  <ul class="guidance-categories-list large">
    <?php foreach($menu_data['large_menu'] as $category): ?>
      <?php $this->view('guidance_index/category_item', $category) ?>
    <?php endforeach ?>
  </ul>

  <ul class="guidance-categories-list small">
    <?php foreach($menu_data['small_menu'] as $category): ?>
      <?php $this->view('guidance_index/category_item', $category) ?>
    <?php endforeach ?>
  </ul>
</div>
